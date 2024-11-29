<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\Store;
use App\Models\Folios;
use Illuminate\Http\Request;
use App\Validators\StoreValidator;
use Illuminate\Http\JsonResponse;
use App\Mail\SendMailController;
use Illuminate\Support\Facades\Mail;

class StoreController extends Controller
{
    // 
    public function index() {

        $data = [];

        $storeTypes = Store::all();

        if ($storeTypes->isEmpty()) {
            $data = [
                'message' => 'No se encontraron registros',
                'status' => 400,
                'result' => [],
            ];

            return response()->json( $data, 200);

        }

        $data = [
            
            'message' => 'Petición exitosa',
            'status' => 200,
            'result' => $storeTypes
        ];

        return response()->json( $data, 200);
    }

    public function create(Request $request)
    {

        $employeeId = null;
        
        $employeeNumber = $request->input('employee_number');
        $employeeName = $request->input('employee_name');
        $employeeId = null;

        if ($employeeNumber) {

            if(empty($employeeName) ) {
                return response()->json([
                    "message" => "Favor de ingresar el nombre del empleado",
                    "status" => 400
                ], 400);
            }
        
            $existEmployee = Employees::where('employee_number', $employeeNumber)->first();
        
            if ($existEmployee) {
                $employeeId = $existEmployee->id_employee;
            } else {
                $employee = Employees::create([
                    'name' => $employeeName,
                    'employee_number' => $employeeNumber
                    
                ]);
        
                $employeeId = $employee->id_employee;
            }
            
        }

        $folio = Folios::Create([
            'folio' => folioGenerator()
        ]);

        $folioId = $folio->id_folio;

        $validator = new StoreValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $store = Store::create([
            'name' => $request->name,
            'street' => $request->street,
            'neighbourhood' => $request->neighbourhood,
            'zip_code' => $request->zip_code,
            'municipality' => $request->municipality,
            'external_number' => $request->external_number,
            'latitude' => $request->latitude,
            'length' => $request->length,
            'email' => $request->email,
            'phone' => $request->phone,
            'seller_name' => $request->seller_name,
            'id_status' => Store::STATUS_PENDING,
            'id_store_type' => $request->id_store_type,
            'id_employee' => $employeeId ?? null,
            'id_folio' => $folioId,
        ]);

        if (!$store) {
            $data = [
                'message' => 'Error al crear la tienda',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'result' => $store,
            'message' => 'Tienda creada con exito',
            'status' => 200
        ];

        // Mail::to('mangeldk6439@gmail.com')->send(new SendMailController());


        return response()->json($data, 200);
    }
    
}

function folioGenerator() {
    // Obtener el último folio de la base de datos
    $lastFolio = Folios::orderBy('folio', 'desc')->first()->folio;

    // Si no existe un registro, iniciar en 1
    if (!$lastFolio) {
        $lastFolio = 0;
    }

    // Incrementar el folio y guardarlo en la base de datos
    $newFolio = $lastFolio + 1;
    $folioFormated = str_pad($newFolio, 6, '0', STR_PAD_LEFT);

    return $folioFormated;
}
