<?php

namespace App\Services\QueryResultsFilters;

use Illuminate\Support\Str;

/**
 * extra filter the queries filtered results (these types of filtering should only be used when the filter is not supported in the database)
 */
abstract class QueryResultsFiltersContract
{
    protected $results;

    /**
     * set the results from the database
     *
     * @param mixed $results
     * @return void
     */
    public function setResults($results)
    {
        $this->results = $results;
    }

    /**
     * apply the filters on the results from a query
     *
     * @param mixed $results
     * @param array $filters
     * @return mixed
     */
    public function apply(array $filters)
    {
        foreach($filters as $filter => $value) {
            $methodName = Str::camel($filter);
            if(! method_exists($this, $methodName)) {
                continue;
            }

            $this->runFilter($methodName, $value);
        }

        return $this->results;
    }

    /**
     * run a filter of the results
     *
     * @param string $methodName
     * @param mixed $filterValue
     * @return void
     */
    protected function runFilter(string $methodName, $filterValue)
    {
        foreach($this->results as $item) {
            $applicaple = $this->$methodName($item, $filterValue);
            if(! $applicaple) {
                $this->removeItem($item);
            }
        }
    }

    /**
     * Add a result to the new filtered results
     *
     * @param mixed $items
     * @return void
     */
    public abstract function removeItem($item);
}