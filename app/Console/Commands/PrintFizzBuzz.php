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
        $result = '';
        if ($number % 3 == 0) {
            $result = 'Fizz';
        }
        if ($number % 5 == 0) {
            $result .= 'Buzz';
        }
        return $result ?: $number;
    }
}
