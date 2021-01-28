<?php

namespace NumbersToWords;

use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected $service;

    /**
     * @dataProvider providerItConvertsNumbersToWords
     *
     * @param int    $number
     * @param string $expectedString
     */
    public function testItConvertsNumbersToWords($number, $expectedString)
    {
        if (null === $this->service) {
            self::markTestIncomplete('Please initialize $numberTransformer property.');
        }

        self::assertEquals($expectedString, $this->service->toWords($number));
    }
}