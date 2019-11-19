<?php

namespace IPSSI\Bibli\Exception;

class NotABookException extends BibliException
{
    private $givenData;

    public function __construct($givenData)
    {
        $this->givenData = $givenData;
    }

    public function getGivenType() : string
    {
        return gettype($this->givenData);
    }
}
