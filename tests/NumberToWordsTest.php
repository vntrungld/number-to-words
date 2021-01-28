<?php

namespace NumbersToWords;

class NumberToWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->service = new NumberToWords();
    }

    public function providerItConvertsNumbersToWords()
    {
        return [
            [0, 'không'],
            [1, 'một'],
            [500, 'năm trăm'],
            [2000, 'hai nghìn'],
            [515500, 'năm trăm mười lăm nghìn năm trăm'],
            [1000000, 'một triệu'],
            [123456789, 'một trăm hai mươi ba triệu bốn trăm năm mươi sáu nghìn bảy trăm tám mươi chín'],
            [1009807654, 'một tỷ không trăm linh chín triệu tám trăm linh bảy nghìn sáu trăm năm mươi bốn'],
            [102030405060, 'một trăm linh hai tỷ không trăm ba mươi triệu bốn trăm linh năm nghìn không trăm sáu mươi'],
            [908070605040302010, 'chín trăm linh tám triệu không trăm bảy mươi nghìn sáu trăm linh năm tỷ không trăm bốn mươi triệu ba trăm linh hai nghìn không trăm mười'],
        ];
    }
}