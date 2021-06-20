<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseFilter
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function build(array $filters)
    {
        foreach($filters as $filter => $value) {
            $methodName = Str::camel($filter);
            if(method_exists($this, $methodName)) {
                $this->model = $this->$methodName($this->model, $value);
            }
        }

        return $this->model;
    }
}