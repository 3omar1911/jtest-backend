<?php

namespace App\Models;

use App\Filters\CustomerFilter\CustomerFilterContract;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $table = 'customer';

    // select * from customer
    // WHERE phone REGEXP "\(237\)\ ?[2368]\d{7,8}$"

    /**
     * given an array of filters return a list of customers
     *
     * @param array $filters
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function filter(CustomerFilterContract $filter, array $filters = [], $paginationData = [])
    {
        $builder = $filter->build($filters);
        
        if(! $paginationData) {
            return $builder->get(); // in case of no filters applied all the data should be returned
        }

        return $builder
            ->offet($paginationData['offset'])
            ->limit($paginationData['limit'])
            ->get();
    }
}
