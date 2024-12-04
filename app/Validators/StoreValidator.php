<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class StoreValidator extends Validator
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function validate(): bool|JsonResponse
    {
        $validator = Validator::make($this->request->all(), [
            'name' => 'required|string|max:50',
            'street' => 'required',
            'neighbourhood' => 'required',
            'zip_code' => 'required',
            'municipality' => 'required',
            'email' => 'required|email|unique:stores',
            'phone' => 'required',
            'seller_name' => 'required',
            'id_store_type' => 'required',

        ]);

        if($validator->fails())  {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        return true;
    }
}
