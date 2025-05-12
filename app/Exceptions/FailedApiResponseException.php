<?php

namespace App\Exceptions;

use Exception;

class FailedApiResponseException extends Exception
{
    public function __construct($message = "Failed API response", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        $response = [
            'error' => 'Error en la respuesta de la API',
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
        ];

        if ($request->expectsJson()) {
            return response()->json($response, 500)->withHeaders([
                'Content-Type' => 'application/json',
                'X-Error-Type' => 'ApiResponseError'
            ]);
        }

        return response($response, $this->getCode());
    }
}
