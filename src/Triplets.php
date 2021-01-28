<?php

namespace NumbersToWords;

class Triplets
{
    const ZERO = 'không';

    const UNITS = [
        null,
        'một',
        'hai',
        'ba',
        'bốn',
        'năm',
        'sáu',
        'bảy',
        'tám',
        'chín',
    ];

    const TEN = 'mười';

    const TY = 'mươi';

    const HUNDRED = 'trăm';

    protected $hundred;
    protected $ten;
    protected $unit;
    protected $thousand;

    public function __construct($number, $thousand)
    {
        $this->unit = $number % 10;
        $number = (int) $number / 10;
        $this->ten = $number % 10;
        $number = (int) $number / 10;
        $this->hundred = $number % 10;
        $this->thousand = $thousand;
    }

    public function toWords()
    {
        $words = [];

        if (!$this->hundred && !$this->ten && !$this->unit) {
            return null;
        }

        if ($this->hasThousand() || $this->hundred) {
            $words[] = $this->getHundred();
        }

        if ($this->ten || ($this->unit && ($this->hundred || $this->hasThousand()))) {
            $words[] = $this->getTen();
        }

        if ($this->unit) {
            $words[] = $this->getUnit();
        }

        return implode(' ', array_filter($words));
    }

    private function getUnit()
    {
        if ($this->ten > 0 && $this->unit === 5) {
            return 'lăm';
        }

        return self::UNITS[$this->unit];
    }

    private function getTen()
    {
        if (!$this->ten && $this->unit && ($this->hundred || $this->hasThousand())) {
            return 'linh';
        }

        if ($this->ten === 1) {
            return self::TEN;
        }

        return self::UNITS[$this->ten] . ' ' . self::TY;
    }

    private function getHundred()
    {
        if (!$this->hundred && $this->hasThousand()) {
            return self::ZERO . ' ' . self::HUNDRED;
        }

        return self::UNITS[$this->hundred] . ' ' . self::HUNDRED;
    }

    private function hasThousand()
    {
        return $this->thousand > 0;
    }
}