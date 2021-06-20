<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $country = $this->country();

        return [
            'id' => $this->id,
            'is_valid' => $this->isValid(),
            'country_code' => $country['code'],
            'country_name' => $country['name'],
            'phone_number' => $this->numberWithoutCountryCode(),
        ];
    }
}
