<?php

require_once __DIR__ . '/ArgsParser.php';

$args = $argv;
unset($args[0]);
try {
    $result = \App\Console\Commands\ArgsParser::parse(implode(' ', $args));
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
echo json_encode($result, JSON_PRETTY_PRINT);
exit(0);
