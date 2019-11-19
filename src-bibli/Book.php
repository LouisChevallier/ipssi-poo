<?php

namespace IPSSI\Bibli;

class Book
{
    /** @var string */
    private $size;

    /** @var int */
    private $floor;

    /** @var bool */
    private $booked;

    /** @var int */
    private $number;

    public function __construct(int $number, string $size, int $floor)
    {
        $this->number = $number;
        $this->size = $size;
        $this->floor = $floor;
        $this->booked = false;
    }

    public function bookIfSuitable(string $size, int $floor): ?int
    {
        if ($this->booked) {
            return null;
        }

        if ($this->size === $size && $this->floor >= $floor) {
            $this->booked = true;
            return $this->number;
        }

        return null;
    }
}
