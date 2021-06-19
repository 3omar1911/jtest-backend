<?php

namespace App\ExceptionsHandlers\ApiValidationExceptionHandler;

use Exception;

interface ApiValidationExceptionHandlerContract
{
    public function handle(Exception $exception);
}