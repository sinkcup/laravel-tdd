<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PrintFizzBuzz extends Command
{
    protected $signature = 'print:fizz-buzz {from=1} {to=100}';

    protected $description = 'CSD FizzBuzz Game';

    public function handle()
    {
        for ($i = $this->argument('from'); $i <= $this->argument('to'); $i++) {
            $this->line(self::format($i));
        }
        return 0;
    }

    public static function format($number)
    {
        $result = $number;
        if ($number % 3 == 0 || strpos("$number", '3') !== false) {
            $result = 'Fizz';
        } elseif ($number % 5 == 0 || strpos("$number", '5') !== false) {
            $result = 'Buzz';
        }
        return $result;
    }
}
