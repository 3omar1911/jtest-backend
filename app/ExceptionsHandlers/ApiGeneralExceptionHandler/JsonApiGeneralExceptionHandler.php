<?php

namespace App\ExceptionsHandlers;

use App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract;
use Exception;

class JsonApiGeneralExceptionHandlerContract implements ApiGeneralExceptionHandlerContract
{
    public function handle(Exception $e, int $responseCode)
    {
        return response()->json([
            'message' => $e->getMessage(),
        ], $responseCode);
    }
}