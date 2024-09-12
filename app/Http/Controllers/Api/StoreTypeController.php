<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoreTypes;
use Illuminate\Http\Request;
use App\Validators\StoreTypesValidator;
use Illuminate\Http\JsonResponse;

class StoreTypeController extends Controller
{
    public function index() {

        $data = [];

        $storeTypes = StoreTypes::all();

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

        $validator = new StoreTypesValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $storeTypes = StoreTypes::create([
            'name' => $request->name
        ]);

        if (!$storeTypes) {
            $data = [
                'message' => 'Error al crear tipo de tienda',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'result' => $storeTypes,
            'message' => 'Tipo de tienda creada con exito',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
