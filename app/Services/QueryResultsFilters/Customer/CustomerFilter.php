<?php

namespace App\Services\QueryResultsFilters\Customer;

use App\Models\Customer;
use App\Services\QueryResultsFilters\QueryResultsFiltersContract;

class CustomerFilter extends QueryResultsFiltersContract implements CustomerQueryResultsFilterContract
{
    /**
     * return whether an item in the result set has the state requested from the client side
     *
     * @param App\Models\Customer $customer
     * @param string $validationValue can be 'valid' or 'invalid'
     * @return boolean
     */
    public function state(Customer $customer, $validationValue): bool
    {
        return $validationValue == 'valid'? $customer->isValid(): ! $customer->isValid();
    }


    public function removeItem($customer)
    {
        $this->results = $this->results->whereNotIn('id', $customer->id);
    }
}