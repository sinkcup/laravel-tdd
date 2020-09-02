<?php

namespace Tests\Unit;

use App\Console\Commands\PrintFizzBuzz;
use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFormat()
    {
        $this->assertEquals(1, PrintFizzBuzz::format(1));
        $this->assertEquals('Fizz', PrintFizzBuzz::format(3));
        $this->assertEquals('Buzz', PrintFizzBuzz::format(5));
        $this->assertEquals('Fizz', PrintFizzBuzz::format(13));
        $this->assertEquals('Fizz', PrintFizzBuzz::format(51));
        $this->assertEquals('Buzz', PrintFizzBuzz::format(52));
        $this->assertEquals('Fizz', PrintFizzBuzz::format(53));
    }
}
