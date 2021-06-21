<?php

namespace App\Services\QueryResultsFilters\Customer;

use App\Models\Customer;

interface CustomerQueryResultsFilterContract
{
    /**
     * return whether an item in the result set has the state requested from the client side
     *
     * @param App\Models\Customer $customer
     * @param string $validationValue can be 'valid' or 'invalid'
     * @return boolean
     */
    public function state(Customer $customer, $validationValue): bool;

    /**
     * set the results from the database
     *
     * @param mixed $results
     * @return void
     */
    public function setResults($results);

    /**
     * apply the filters on the results from a query
     *
     * @param mixed $results
     * @param array $filters
     * @return mixed
     */
    public function apply(array $filters);
}