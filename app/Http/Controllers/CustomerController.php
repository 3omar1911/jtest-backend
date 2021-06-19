<?php

namespace App\Http\Controllers;

use App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $apiGeneralExceptionHandler;

    public function __construct(ApiGeneralExceptionHandlerContract $apiGeneralExceptionHandler)
    {
        $this->apiGeneralExceptionHandler = $apiGeneralExceptionHandler;
    }

    public function list(Request $request)
    {
        try {
            // TODO::call the method used for filteration on the customer model
            // TODO::format the response (maybe by using the eloquent api resources)
        } catch(Exception $e) {
            return $this->apiGeneralExceptionHandler->handle($e, 500);
        }
    }
}
