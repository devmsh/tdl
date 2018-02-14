<?php

namespace Tests\Unit;

use App\Calc;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function test_can_add_two_numbers()
    {
        $calc = new Calc();
        $result = $calc->div(10,2);

        $this->assertEquals(5,$result);
    }

    public function test_handel_divide_by_zero()
    {
        $calc = new Calc();
        $result = $calc->div(10,0);

        $this->assertEquals("Nan",$result);
    }
}
