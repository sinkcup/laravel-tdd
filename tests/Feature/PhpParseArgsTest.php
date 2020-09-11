<?php

namespace Tests\Feature;

use Tests\TestCase;

class PhpParseArgsTest extends TestCase
{
    private $command = '';
    protected function setUp(): void
    {
        parent::setUp();
        $this->command = 'php ' . app_path('Console/Commands/php-command.php');
    }

    public function testInvalidArg()
    {
        exec($this->command . ' -a', $output, $code);
        $this->assertEquals('illegal argument: -a', $output[0]);
        $this->assertNotEquals(0, $code);
    }

    public function testInvalidArgBool()
    {
        exec($this->command . ' -l foo', $output, $code);
        $this->assertEquals('invalid argument: -l should has no value', $output[0]);
        $this->assertNotEquals(0, $code);
    }

    public function testInvalidArgIntNoValue()
    {
        exec($this->command . ' -p', $output, $code);
        $this->assertEquals('invalid argument: -p should be int', $output[0]);
        $this->assertNotEquals(0, $code);
    }

    public function testInvalidArgIntBadValue()
    {
        exec($this->command . ' -p foo', $output, $code);
        $this->assertEquals('invalid argument: -p should be int', $output[0]);
        $this->assertNotEquals(0, $code);
    }

    public function testInvalidArgStringNoValue()
    {
        exec($this->command . ' -d', $output, $code);
        $this->assertEquals('invalid argument: -d should be string', $output[0]);
        $this->assertNotEquals(0, $code);
    }

    public function testParseArgs()
    {
        exec($this->command . ' -l -p 8080 -d /usr/logs', $output, $code);

        $this->assertEquals('{', $output[0]);
        $this->assertEquals('"l": true,', trim($output[1]));
        $this->assertEquals('"p": 8080,', trim($output[2]));
        $this->assertEquals('"d": "\/usr\/logs"', trim($output[3]));
        $this->assertEquals('}', $output[4]);
        $this->assertEquals(0, $code);
    }
}
