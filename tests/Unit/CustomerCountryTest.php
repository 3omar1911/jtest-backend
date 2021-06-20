<?php

namespace Tests\Unit;

use App\Models\Customer;
use Tests\TestCase;

class CustomerCountryTest extends TestCase
{
    /**
     * test when customer belongs to real country the customer model confirms that
     *
     * @return void
     */
    public function test_when_customer_belongs_to_real_country()
    {
        $customer = new Customer([
            'id' => rand(1, 5000),
            'phone' => "(212) 699209115",
            'name' => "Test Name"
        ]);

        $country = $customer->country();
        $this->assertEquals('212', $country['code']);
        $this->assertEquals('Western Sahara', $country['name']);
    }

    /**
     * test when customer belongs to unreal country the customer model confirms that
     *
     * @return void
     */
    public function test_when_customer_belongs_to_unreal_country()
    {
        $customer = new Customer([
            'id' => rand(1, 5000),
            'phone' => "(111111111111111) 699209115",
            'name' => "Test Name"
        ]);

        $country = $customer->country();
        $this->assertNull($country['name']);
    }

    /**
     * test when customer doesn't have a country code the expected return value is returned from the model
     *
     * @return void
     */
    public function test_when_customer_phone_doesnot_have_country_code()
    {
        $customer = new Customer([
            'id' => rand(1, 5000),
            'phone' => rand(11111, 999999),
            'name' => "Test Name"
        ]);

        $country = $customer->country();
        $this->assertNull($country);
    }

}
