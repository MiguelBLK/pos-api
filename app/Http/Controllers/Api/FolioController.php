<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Folios;
use App\Validators\FolioValidator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FolioController extends Controller
{
    function index() {
        return response()->json([
            'message' => 'Petición exitosa',
            'status' => 200,
            'result' => [
                    [
                        'id_folio' => 1,
                        'folio' => '123456789',
                    ],
            ]
        ], 200);
    }

    public function create(Request $request)
    {

        $validator = new FolioValidator($request);
        $validationResult = $validator->validate();

        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $folio = Folios::create([
            'folio' => $request->folio,
        ]);

        if (!$folio) {
            $data = [
                'message' => 'Error al crear folio',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'result' => $folio,
            'message' => 'Folio creado con exito',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
