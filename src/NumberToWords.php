<?php

namespace NumbersToWords;

class NumberToWords
{
    const ZERO = 'không';

    const EXPONENT = [
        null,
        'nghìn',
        'triệu',
        'tỷ',
    ];

    public function toWords($value)
    {
        if ($value === 0) {
            return self::ZERO;
        }

        $triplets = [];
        $number = $value;

        while ($number > 0) {
            $triplets[] = $number % 1000;
            $number = (int) ($number / 1000);
        }
        $total_triplets = count($triplets);
        $words = [];

        for ($i = 0; $i < $total_triplets; $i++) {
            $before = 0;

            if ($i < $total_triplets - 1) {
                $before = $triplets[$i + 1];
            }

            if ($triplets[$i] > 0) {
                $triplet = new Triplets($triplets[$i], $before);
                $words[] = $this->getExponent($i);
                $words[] = $triplet->toWords();
            }
        }

        return implode(' ', array_reverse(array_filter($words)));
    }

    private function getExponent($index)
    {
        $total_exponent = count(self::EXPONENT);

        if ($index < $total_exponent) {
            return self::EXPONENT[$index];
        }

        $index = $index % ($total_exponent - 1);

        if ($index === 0) {
            return self::EXPONENT[$total_exponent - 1];
        }

        return self::EXPONENT[$index];
    }
}