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
}
