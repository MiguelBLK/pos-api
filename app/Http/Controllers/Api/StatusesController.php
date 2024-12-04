<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Statuses;
use Illuminate\Http\Request;
use App\Validators\StatusesValidator;
use Illuminate\Http\JsonResponse;

class StatusesController extends Controller
{
    public function index() {

        $data = [];

        $statuses = Statuses::all();

        if ($statuses->isEmpty()) {
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
            'result' => $statuses
        ];

        return response()->json( $data, 200);
    }

    public function create(Request $request)
    {

        $validator = new StatusesValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $statuses = Statuses::create([
            'name' => $request->name
        ]);

        if (!$statuses) {
            $data = [
                'message' => 'Error al crear status',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'result' => $statuses,
            'message' => 'Status creada con exito',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
