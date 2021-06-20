<?php

namespace Tests\Unit;

use App\Models\Customer;
use Tests\TestCase;

class CustomerPhoneValidityTest extends TestCase
{
    /**
     * test when customer phone is valid the customer model confirms that
     *
     * @return void
     */
    public function test_when_customer_phone_is_valid()
    {
        $customer = new Customer([
            'id' => rand(1, 5000),
            'phone' => "(212) 699209115",
            'name' => "Test Name"
        ]);

        $this->assertTrue($customer->isValid());
    }

    /**
     * test when customer phone is invalid the customer model confirms that
     *
     * @return void
     */
    public function test_when_customer_phone_is_invalid()
    {
        $customer = new Customer([
            'id' => rand(1, 5000),
            'phone' => "(20) 699209115",
            'name' => "Test Name"
        ]);

        $this->assertFalse($customer->isValid());
    }
}
