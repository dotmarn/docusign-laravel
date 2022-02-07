<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AppUtils
{
    public function setResponse($status, $data = null, $message = null, $error = null){

        $response = ['status' => $status];
        $data = request()->base64_response ? base64_encode(json_encode($data ?? [])) : $data;

        !is_null($data) && $response['data'] = $data;
        !is_null($message) && $response['message'] = $message;
        !is_null($error) && $response['error'] = $error;
        $response = request()->base64_body ? base64_encode(json_encode($response)) : $response;

        return response()->json(
            $response, $status
        );
    }

    public function validation($requestBody, $validateBody, $extraValidation = [])
    {
        $validator = Validator::make($requestBody, $validateBody, $extraValidation);
        // if ($validator->fails()) {
        //     throw new ValidationException($validator->errors());
        // }
    }
}
