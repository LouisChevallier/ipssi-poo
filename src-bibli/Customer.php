<?php

namespace IPSSI\Bibli;

class Customer
{
    /** @var string */
    private $claimedBookSize;

    /** @var int */
    private $claimedMinFloor;

    /** @var int */
    private $bookNumber;

    public function __construct(string $claimedBookSize, int $claimedMinFloor)
    {
        $this->claimedBookSize = $claimedBookSize;
        $this->claimedMinFloor = $claimedMinFloor;
    }

    public function orderBookTo(Bibli $bibli)
    {
        $bibli->provideBookTo($this, $this->claimedBookSize, $this->claimedMinFloor);
    }

    public function setBookNumber(int $bookNumber): self
    {
        $this->bookNumber = $bookNumber;

        return $this;
    }

    public function doYouHaveABook(): string
    {
        if (null === $this->bookNumber) {
            return "Non je vais voir si je peux le trouver";
        }

        return "Oui j'i le livre numéro " . $this->bookNumber;
    }
}
