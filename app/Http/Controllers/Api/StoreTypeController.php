<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StoreTypes;
use Illuminate\Http\Request;

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
}
