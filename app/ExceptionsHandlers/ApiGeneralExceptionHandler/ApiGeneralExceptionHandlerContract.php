<?php

namespace App\ExceptionsHandlers\ApiGeneralExceptionHandler;

use Exception;

interface ApiGeneralExceptionHandlerContract
{
    public function handle(Exception $exception, int $responseCode);
}