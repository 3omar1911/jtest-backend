<?php

namespace App\Models;

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
     * @return mixed
     */
    public static function filter(array $filters = [])
    {
        // TODO::implement a filteration class to build the query responsible for filtering the customers then return the result
    }
}
