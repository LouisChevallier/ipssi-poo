<?php

require_once('vendor/autoload.php');

use Ipssi\Evaluation\Useless;

new Useless(); // Ceci ne sert à rien

class Document
 {
     private $elements = array();

    
     private $rouge;
     private $vert;
     private $bleu;

     public function __construct(int $r,int $v,int $b)
     {
         $this->rouge = $r;
         $this->vert = $v;
         $this->bleu = $b;
     }

     public function newElement(string $id)
     {
         $this->elements[] = $id;
     }

     /**
      * @return array
      */
     public function getElements()
     {
         return $this->elements;
     }

     /**
      * @return array
      */
     public function getColor()
     {
         return array($this->rouge,$this->vert,$this->bleu);
     }

 }

 class Element
 {
     private $id;
     private $positionX;
     private $positionY;

     /**
      * @return mixed
      */
     public function __construct($x,$y)
     {
         $this->id = uniqid();
         $this->positionX = $x;
         $this->positionY = $y;
     }

     /**
      * @return string
      */
     public function getPosition()
     {
         return array($this->positionX,$this->positionY);
     }

     /**
      * @return string
      */
     public function getId()
     {
         return $this->id;
     }
 }

 class Text extends Element
 {
     private $rouge;
     private $vert;
     private $bleu;

     private $text;

     public function __construct(int $x,int $y,int $r,int $v,int $b,string $txt)
     {
         parent::__construct($x, $y);
         $this->rouge = $r;
         $this->vert = $v;
         $this->bleu = $b;
         $this->text = $txt;

     }

     /**
      * @return array
      */
     public function getColor()
     {
         return array($this->rouge,$this->vert,$this->bleu);
     }

     /**
      * @return string
      */
     public function getName()
     {
         return $this->text;
     }
 }

 class Image extends Element{

    private $img;

    public function __construct(int $x,int $y,string $img)
    {
        parent::__construct($x, $y);
        $this->img = $img;

    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->img;
    }
}

 class Forme extends Element
 {
     private $forme;
     private $rouge;
     private $vert;
     private $bleu;

     public function __construct(int $x,int $y,int $r,int $v,int $b,string $forme)
     {
         parent::__construct($x, $y);
         $this->rouge = $r;
         $this->vert = $v;
         $this->bleu = $b;
         $this->forme = $forme;

     }

     /**
      * @return array
      */
     public function getColor()
     {
         return array($this->rouge,$this->vert,$this->bleu);
     }

     /**
      * @return string
      */
     public function getName()
     {
         return $this->forme;
     }
 }


 $document = new Document(0,0,0);

 $elements[] = new Text(200,200,0,0,255,'Lorem ipsum');
 $elements[] = new Forme(100,200,0,0,255,'Etoile');
 $elements[] = new Image(100,50,"image.png");