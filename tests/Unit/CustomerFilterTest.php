<?php

namespace Tests\Unit;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CustomerFilterTest extends TestCase
{
    private $data = [];

    public function setUp(): void
    {
        parent::setUp();
        DB::statement("CREATE TABLE customer (id int, name varchar(50), phone varchar(50))");
        $this->data = [
            [
                "id" => 1,
                "name" => "valid customer from Western Sahara",
                "phone" => "(212) 698054317",
            ],

            [
                "id" => 2,
                "name" => "invalid customer from Western Sahara",
                "phone" => "(212) 6546545369",
            ],

            [
                "id" => 3,
                "name" => "valid customer from Cameron",
                "phone" => "(237) 697151594",
            ],
        ];

        foreach($this->data as $item) {
            Customer::create($item);
        }
    }

    private function applyFilters(array $filters)
    {
        return (new Customer())->filter(
            resolve('App\Filters\CustomerFilter\CustomerFilterContract'), 
            resolve('App\Services\QueryResultsFilters\Customer\CustomerQueryResultsFilterContract'), 
            $filters
        );
    }

    /**
     * make sure that when no filters applied all the results are returned
     *
     * @return void
     */
    public function test_when_no_filter_applied()
    {
        $results = $this->applyFilters([]);
        $this->assertFalse($results->isEmpty());
        $this->assertEquals(count($this->data), $results->count());
    }

    /**
     * ensure that when an empty result should be returned due to non-existing country code that it's the case
     *
     * @return void
     */
    public function test_that_when_a_not_existing_country_code_applied_as_a_filter_no_results_returned()
    {
        $results = $this->applyFilters(['country_code' => '20']);
        $this->assertTrue($results->isEmpty());
    }

    /**
     * ensrure that when an existing country code is applied as filter, only the customers belonging to that counrty are returned
     *
     * @return void
     */
    public function test_existing_country_code_filter()
    {
        $results = $this->applyFilters(['country_code' => '237']);
        $this->assertFalse($results->isEmpty());
        $codes = [];
        $results->each(function($customer) use (&$codes) {
            array_push($codes, $customer->country()['code']);
        });

        $this->assertEquals(1, count($codes));
        $this->assertEquals($codes[0], '237');
    }

    /**
     * test the state filter 
     *
     * @return void
     */
    public function test_state_filter()
    {
        $results = $this->applyFilters(['state' => 'valid']);
        $this->assertFalse($results->isEmpty());
        $invalid = 0;

        $results->each(function($customer) use($invalid) {
            if(! $customer->isValid()) {
                $invalid++;
            }
        });

        $this->assertEquals(0, $invalid);
    }

}
