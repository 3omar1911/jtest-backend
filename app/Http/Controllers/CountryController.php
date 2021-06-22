<?php

namespace App\Http\Controllers;

class CountryController extends Controller
{
    public function list()
    {
        return response()->json(config('countryCode'));
    }
}
