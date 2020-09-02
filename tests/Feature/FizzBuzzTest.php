<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHandle()
    {
        $this->artisan('print:fizz-buzz 1 15')
            ->expectsOutput('1')
            ->expectsOutput('2')
            ->expectsOutput('Fizz')
            ->expectsOutput('4')
            ->expectsOutput('Buzz')
            ->expectsOutput('Fizz')
            ->expectsOutput('7')
            ->expectsOutput('8')
            ->expectsOutput('Fizz')
            ->expectsOutput('Buzz')
            ->expectsOutput('11')
            ->expectsOutput('Fizz')
            ->expectsOutput('13')
            ->expectsOutput('14')
            ->expectsOutput('FizzBuzz')
            ->assertExitCode(0);
    }
}
