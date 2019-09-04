<?php

namespace marcocesarato\dumper\tests;

use marcocesarato\dumper\Dumper;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    /**
     * Test Get Dump
     */
    public function testGetDump()
    {
        $arr = [1, 2, 3, 4, 5];
        $this->assertEquals(
            "PGNvZGU+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMDAwIj4KPHNwYW4gc3R5bGU9ImNvbG9yOiAjMDAwMEJCIj48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5hcnJheTxiciAvPig8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDtbPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+MDwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjE8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+MTwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjI8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+Mjwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjM8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+Mzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjQ8YnIgLz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj5bPC9zcGFuPjxzcGFuIHN0eWxlPSJjb2xvcjogIzAwMDBCQiI+NDwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDc3MDAiPl0mbmJzcDs9Jmd0OyZuYnNwOzwvc3Bhbj48c3BhbiBzdHlsZT0iY29sb3I6ICMwMDAwQkIiPjU8YnIgLz48L3NwYW4+PHNwYW4gc3R5bGU9ImNvbG9yOiAjMDA3NzAwIj4pPC9zcGFuPgo8L3NwYW4+CjwvY29kZT4=",
            base64_encode(Dumper::get($arr))
        );
    }

    /**
     * Test Get Depth
     */
    public function testGetDepth()
    {
        $expectedDepth = 100;

        Dumper::setDepth($expectedDepth);

        $this->assertEquals($expectedDepth, Dumper::getDepth());
    }

    /**
     * Test Get Highlight
     */
    public function testGetHighlight()
    {
        Dumper::enableHighlight();

        $this->assertTrue(Dumper::getHighlight());

        Dumper::disableHighlight();

        $this->assertFalse(Dumper::getHighlight());
    }
}
