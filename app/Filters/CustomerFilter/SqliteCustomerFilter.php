<?php

namespace App\Filters\CustomerFilter;

use App\Filters\BaseFilter;

class SqliteCustomerFilter extends BaseFilter implements CustomerFilterContract
{
    public function countryCode($queryBuilder, $countryCode)
    {
        return $queryBuilder->where('phone', 'like', "(%$countryCode%)");
    }

    public function stateValid($queryBuilder, $countryCode)
    {
        return $queryBuilder->where(function($query) {
            $query->whereRaw('phone REGEXP "\(237\)\ ?[2368]\d{7,8}$"')
                ->orWhereRaw('phone REGEXP "\(251\)\ ?[1-59]\d{8}$"')
                ->orWhereRaw('phone REGEXP "\(212\)\ ?[5-9]\d{8}$"')
                ->orWhereRaw('phone REGEXP "\(258\)\ ?[28]\d{7,8}$"')
                ->orWhereRaw('phone REGEXP "\(256\)\ ?\d{9}$"');
        });
    }

    public function stateInValid($queryBuilder, $countryCode)
    {
        return $queryBuilder->where(function($query) {
            $query->whereNotRaw('phone REGEXP "\(237\)\ ?[2368]\d{7,8}$"')
                ->andNotWhereRaw('phone REGEXP "\(251\)\ ?[1-59]\d{8}$"')
                ->andNotWhereRaw('phone REGEXP "\(212\)\ ?[5-9]\d{8}$"')
                ->andNotWhereRaw('phone REGEXP "\(258\)\ ?[28]\d{7,8}$"')
                ->andNotWhereRaw('phone REGEXP "\(256\)\ ?\d{9}$"');
        });
    }
}