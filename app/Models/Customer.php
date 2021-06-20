<?php

namespace App\Models;

use App\Filters\CustomerFilter\CustomerFilterContract;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $table = 'customer';

    /**
     * given an array of filters return a list of customers
     *
     * @param array $filters
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function filter(CustomerFilterContract $filter, array $filters = [])
    {
        $builder = $filter->build($filters);
        return $builder->get(); // in case of no filters applied all the data should be returned
    }

    /**
     * returns whether the phone number is valid or not
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return preg_match("/\(237\)\ ?[2368]\d{7,8}$/", $this->phone) || 
            preg_match("/\(251\)\ ?[1-59]\d{8}$/", $this->phone) || 
            preg_match("/\(212\)\ ?[5-9]\d{8}$/", $this->phone) || 
            preg_match("/\(258\)\ ?[28]\d{7,8}$/", $this->phone) || 
            preg_match("/\(256\)\ ?\d{9}$/", $this->phone);
    }

    /**
     * get the country parameters from the customer's phone number
     *
     * @return array
     */
    public function country(): array
    {
        $found = preg_match("/\(([0-9]+?)\)/", $this->phone, $result);
        
        if(! $found) {
            return null;
        }

        return [
            'code' => $result[1],
            'name' => config('countryCode.'. $result[1]),
        ];
    }

    public function numberWithoutCountryCode(): string
    {
        $params = explode(') ', $this->phone);
        if(count($params) < 2) {
            return null;
        }

        return $params[1];
    }
}
