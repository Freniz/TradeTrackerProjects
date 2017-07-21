<?php

use Tracker_XMLRenderer;

class TradetrackerTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->url        = 'http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=1';
        $this->xmlrender = new Tracker_XMLRenderer($this->url);
    }

    /**
    *@group test Url Decode
    */
    public function testUrlDecode()
    {
        $url = 'http%3A%2F%2Fwww.tradetracker.com%2F';
        $expected = 'http://www.tradetracker.com/';
        $actual = $this->xmlrender->urlDecode($url);
        $this->assertEquals($expected, $actual);
    }

    /**
    *@group test Trim String
    */
    public function testTrimString()
    {
        $content = 'Be happy for this moment. This moment is your life.';
        $expected = 'Be happy for this moment...';
        $actual = $this->xmlrender->trimString($content, 27);
        $this->assertEquals($expected, $actual);
    }
}
