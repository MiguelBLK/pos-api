<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Validators\EmployeesValidator;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    public function index() {

        $data = [];

        $employees = Employees::all();

        if ($employees->isEmpty()) {
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
            'result' => $employees
        ];

        return response()->json( $data, 200);
    }

    public function create(Request $request)
    {

        $validator = new EmployeesValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $employees = Employees::create([
            'name' => $request->name,
            'employee_number' => $request->employee_number
        ]);

        if (!$employees) {
            $data = [
                'message' => 'Error al crear employee',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'result' => $employees,
            'message' => 'Employee creado con exito',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
