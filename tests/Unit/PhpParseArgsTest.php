<?php

namespace Tests\Unit;

use App\Console\Commands\ArgsParser;
use PHPUnit\Framework\TestCase;

class PhpParseArgsTest extends TestCase
{
    public function testParseOneArg()
    {
        $result = ArgsParser::parse('-l');
        $this->assertTrue($result['l']);

        $result = ArgsParser::parse('-p 8080');
        $this->assertSame(8080, $result['p']);

        $result = ArgsParser::parse('-d /usr/logs');
        $this->assertEquals('/usr/logs', $result['d']);
    }

    public function testParseArgs()
    {
        $result = ArgsParser::parse('-l -p 8080 -d /usr/logs');
        $this->assertTrue($result['l']);
        $this->assertSame(8080, $result['p']);
        $this->assertEquals('/usr/logs', $result['d']);
    }

    public function testParseIllegalArg()
    {
        $this->expectException(\InvalidArgumentException::class);
        ArgsParser::parse('-a');
    }

    public function testParseInvalidArgInt()
    {
        $this->expectException(\InvalidArgumentException::class);
        ArgsParser::parse('-p foo');
    }

    public function testParseInvalidArgString()
    {
        $this->expectException(\InvalidArgumentException::class);
        ArgsParser::parse('-d');
    }
}
