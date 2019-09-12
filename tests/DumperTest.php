<?php

namespace marcocesarato\dumper\tests;

use marcocesarato\dumper\Dumper;
use PHPUnit\Framework\TestCase;
use stdClass;

final class DumperTest extends TestCase
{
    protected $resource;

    protected function setUp()
    {
        $this->resource = fopen(__DIR__ . '/../composer.json', 'r');
    }

    /**
     * Test instance.
     */
    public function testInstance()
    {
        $this->assertInstanceOf(
            Dumper::class,
            new Dumper()
        );
    }

    /**
     * Test Get Dump on array.
     */
    public function testGetDumpOnArray()
    {
        $arr = [1, 2, 3, 4, 5];
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5hcnJheTxiciAvPig8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDtbPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+MDwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjE8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+MTwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjI8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+Mjwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjM8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+Mzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjQ8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+NDwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjU8YnIgLz48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj4pPC9zcGFuPgo8L3NwYW4+CjwvY29kZT4=',
            base64_encode(Dumper::get($arr))
        );
    }

    /**
     * Test Get Dump on boolean.
     */
    public function testGetDumpOnBoolean()
    {
        $boolean = true;
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj50cnVlPC9zcGFuPgo8L3NwYW4+CjwvY29kZT4=',
            base64_encode(Dumper::get($boolean))
        );
    }

    /**
     * Test Get Dump on double.
     */
    public function testGetDumpOnDouble()
    {
        $double = 1.2;
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj4xLjI8L3NwYW4+Cjwvc3Bhbj4KPC9jb2RlPg==',
            base64_encode(Dumper::get($double))
        );
    }

    /**
     * Test Get Dump on string.
     */
    public function testGetDumpOnString()
    {
        $string = 'string';
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjREQwMDAwIj4nc3RyaW5nJzwvc3Bhbj4KPC9zcGFuPgo8L2NvZGU+',
            base64_encode(Dumper::get($string))
        );
    }

    /**
     * Test Get Dump on resource.
     */
    public function testGetDumpOnResource()
    {
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj57PC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+cmVzb3VyY2U8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj59PC9zcGFuPgo8L3NwYW4+CjwvY29kZT4=',
            base64_encode(Dumper::get($this->resource))
        );
    }

    /**
     * Test Get Dump on null.
     */
    public function testGetDumpOnNull()
    {
        $null = null;
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj5udWxsPC9zcGFuPgo8L3NwYW4+CjwvY29kZT4=',
            base64_encode(Dumper::get($null))
        );
    }

    /**
     * Test Get Dump on object.
     */
    public function testGetDumpOnObject()
    {
        $null = new stdClass();
        $this->assertEquals(
            'PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj5zdGRDbGFzczwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICNGRjgwMDAiPiMxPGJyIC8+PC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwNzcwMCI+KDxiciAvPik8L3NwYW4+Cjwvc3Bhbj4KPC9jb2RlPg==',
            base64_encode(Dumper::get($null))
        );
    }

    /**
     * Test Get Depth.
     */
    public function testGetDepth()
    {
        $expectedDepth = 100;

        Dumper::setDepth($expectedDepth);

        $this->assertEquals($expectedDepth, Dumper::getDepth());
    }

    /**
     * Test Get Highlight.
     */
    public function testGetHighlight()
    {
        Dumper::enableHighlight();

        $this->assertTrue(Dumper::getHighlight());

        Dumper::disableHighlight();

        $this->assertFalse(Dumper::getHighlight());
    }

    protected function tearDown()
    {
        fclose($this->resource);
    }
}
