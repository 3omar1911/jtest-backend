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
    private $customerModel;

    public function __construct(ApiGeneralExceptionHandlerContract $apiGeneralExceptionHandler, ApiValidationExceptionHandlerContract $apiValidationExceptionHandler, Customer $customerModel)
    {
        $this->apiGeneralExceptionHandler = $apiGeneralExceptionHandler;
        $this->apiValidationExceptionHandler = $apiValidationExceptionHandler;
        $this->customerModel = $customerModel;
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
            $customers = $this->customerModel->filter(
                resolve('App\Filters\CustomerFilter\CustomerFilterContract'), 
                resolve('App\Services\QueryResultsFilters\Customer\CustomerQueryResultsFilterContract'), 
                $request->all()
            );

            if($customers->isEmpty()) {
                return response(null, 204);
            }

            return new CustomerCollection($customers);
        } catch(ValidationException $e) {
            return $this->apiValidationExceptionHandler->handle($e);
        } catch(Exception $e) {
            return $this->apiGeneralExceptionHandler->handle($e, 500);
        }
    }
}
