<?php

use IPSSI\Bibli\Exception\NotABookException;

require_once('vendor/autoload.php');


/* BIBLI -------------------------------------------*/
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

    public function provideBookTo(Lecteur $lecteur, string $title)
    {
        foreach ($this->books as $book) {
            $bookNumber = $book->borrowIfDispo($title);

            if ($bookNumber !== null) {
                $lecteur->setBookNumber($bookNumber);
                break;
            }
        }
    }

}


/* LECTEUR -------------------------------------------*/
class Lecteur
{
    /** @var string */
    private $claimedBookTitle;

    /** @var int */
    private $bookNumber;

    public function __construct(string $claimedBookTitle)
    {
        $this->claimedBookTitle = $claimedBookTitle;
    }

    public function orderBookTo(Bibli $bibli)
    {
        $bibli->provideBookTo($this, $this->claimedBookTitle);
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

        return "Oui, pour le livre " . $this->claimedBookTitle . " j'ai le numéro " . $this->bookNumber;
    }
}


/* BOOK -------------------------------------------*/
class Book
{
    /** @var string */
    private $title;

    /** @var bool */
    private $booked;

    /** @var int */
    private $number;

    public function __construct(int $number, string $title)
    {
        $this->number = $number;
        $this->title = $title;
        $this->booked = false;
    }

    public function borrowIfDispo(string $title): ?int
    {
        if ($this->booked) {
            return null;
        }

        if ($this->title === $title) {
            $this->booked = true;
            return $this->number;
        }

        return null;
    }
}


/* TRY AVEC NOS DONNÉES ----------------------------------------*/
try {

    $albert = new Lecteur('Hobbit');

    $camus = new Bibli([
        new Book(40, 'Harrypotter'),
        new Book(120, 'Hobbit'),
        new Book(243, 'Hungergames'),
        new Book(264, 'Hobbit'),
    ]);

    echo $albert->doYouHaveABook() . PHP_EOL;
    $albert->orderBookTo($camus);
    echo $albert->doYouHaveABook() . PHP_EOL;

} catch (NotABookException $e) {
    echo sprintf(
        "Erreur lors de la crétion de l'HOtel",
        $e->getGivenType()
    ) . PHP_EOL;
}