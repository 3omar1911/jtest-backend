<?php

namespace App\Filters\CustomerFilter;

use App\Filters\BaseFilter;

class SqliteCustomerFilter extends BaseFilter implements CustomerFilterContract
{
    /**
     * filter by country code
     *
     * @param mixed $queryBuilder
     * @param string $countryCode
     * @return void
     */
    public function countryCode($queryBuilder, $countryCode)
    {
        return $queryBuilder->where('phone', 'like', "%($countryCode)%");
    }
}