<?php

namespace App\ExceptionsHandlers\ApiValidationExceptionHandler;

use App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract;
use Exception;

class JsonApiValidationExceptionHandler implements ApiValidationExceptionHandlerContract
{
    public function handle(Exception $e)
    {
        return response()->json([
            'message' => $e->getMessage(),
        ], 400);
    }
}