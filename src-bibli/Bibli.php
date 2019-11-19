<?php

namespace IPSSI\Bibli;

use IPSSI\Bibli\Exception\NotABookException;

class Bibli
{
    private $books;

    public function __construct(array $books)
    {
        foreach ($books as $book) {
            if (false === $book instanceof Book) {
                throw new NotABookException($book);
            }
        }

        $this->books = $books;
    }

    public function provideBookTo(Customer $customer, string $size, int $floor)
    {
        foreach ($this->books as $book) {
            /** @var Book $room */
            $bookNumber = $book->bookIfSuitable($size, $floor);

            if ($bookNumber !== null) {
                $customer->setBookNumber($bookNumber);
                break;
            }
        }
    }

}
