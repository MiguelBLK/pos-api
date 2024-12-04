<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class FolioValidator extends Validator
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function validate(): bool|JsonResponse
    {
        $validator = Validator::make($this->request->all(), [
            'folio' => 'required|string|max:6',

        ]);

        if($validator->fails())  {
            $data = [
                'message' => 'Error en la validación de los datos ""',
                'errors' => $validator->errors(),
                'code' => 400
            ];

            return response()->json($data, 400);
        }

        return true;
    }
}
