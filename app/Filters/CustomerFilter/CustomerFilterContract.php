<?php

namespace App\Filters\CustomerFilter;

interface CustomerFilterContract
{
    public function build(array $filters);
    public function countryCode($queryBuilder, $countryCode);
    public function state($queryBuilder, $countryCode);
}