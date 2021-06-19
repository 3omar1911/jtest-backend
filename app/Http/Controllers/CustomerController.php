<?php

namespace App\Http\Controllers;

use App\ExceptionsHandlers\ApiGeneralExceptionHandler\ApiGeneralExceptionHandlerContract;
use App\ExceptionsHandlers\ApiValidationExceptionHandler\ApiValidationExceptionHandlerContract;
use App\Http\Resources\CustomerCollection;
use App\Models\Customer;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $apiGeneralExceptionHandler;
    private $apiValidationExceptionHandler;

    public function __construct(ApiGeneralExceptionHandlerContract $apiGeneralExceptionHandler, ApiValidationExceptionHandlerContract $apiValidationExceptionHandler)
    {
        $this->apiGeneralExceptionHandler = $apiGeneralExceptionHandler;
        $this->apiValidationExceptionHandler = $apiValidationExceptionHandler;
    }

    /**
     * fetch the customers from the database, format, then send them to the caller
     *
     * @param Request $request
     * @return Json
     */
    public function list(Request $request)
    {
        try {
            $this->validate($request, ['page' => 'integer']);
            $customers = Customer::filter(resolve('App\Filters\CustomerFilter\CustomerFilterContract'), $request->all(), [
                'offset' => $request->page? $request->page * config('app.customer_request_limit'): 0,
                'limit' => config('app.customer_request_limit'),
            ]);

            if($customers->isEmpty()) {
                return response(null, 204);
            }

            return new CustomerCollection($customers);
        } catch(ValidationException $e) {
            return $this->api;
        } catch(Exception $e) {
            return $this->apiGeneralExceptionHandler->handle($e, 500);
        }
    }
}
