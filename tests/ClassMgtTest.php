<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\KingMathController;

class ClassMgtTest extends TestCase
{
    protected $km;

    protected function setUp()
    {
        $this->km = new KingMathController;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalHire()
    {
        $number_of_time = -12;
        $hiring_rate = 500;

        $number_of_time1 = 12;
        $hiring_rate1 = 500;
        $result = $number_of_time1 * $hiring_rate;

        $this->assertEquals($result, $this->km->calHire($number_of_time, $hiring_rate));
        //$this->assertTrue(true);
    }
}
