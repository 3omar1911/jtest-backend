<?php

namespace App\ExceptionsHandlers\ApiGeneralExceptionHandler;

use App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract;
use Exception;

class JsonApiGeneralExceptionHandler implements ApiGeneralExceptionHandlerContract
{
    public function handle(Exception $e, int $responseCode)
    {
        return response()->json([
            'message' => $e->getMessage(),
        ], $responseCode);
    }
}