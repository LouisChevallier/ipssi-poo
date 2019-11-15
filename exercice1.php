<?php

require_once('vendor/autoload.php');

$climate = new League\CLImate\CLImate;

class Diviseur {
    public function division(int $index, int $diviseur)
    {
        $valeurs = [17, 12, 15, 38, 29, 157, 89, -22, 0, 5];

        if($diviseur === 0){
            throw new DivisionBy0Exception();
        }
        if(empty($index) || empty($diviseur)){
            throw new EmptyInputException();
        }
        if($index > (($index < 0) || count($valeurs)-1)){
            throw new IndexToBigException();
        }
        if(!is_numeric($index) || !is_numeric($diviseur)){
            throw new DivisionWithStrException();
        }

        return $valeurs[$index] / $diviseur;
    }
}

$error = 1;
while($error === 1){
    $input = $climate->input("Entrez l’indice de l’entier à diviser : ");
    $index = $input->prompt();

    $input = $climate->input("Entrez le diviseur : ");
    $diviseur = $input->prompt();

    try{
        $climate->output("Le résultat de la division est : " . (new Diviseur())->division($index, $diviseur));
        $error = 0;
    } catch (Exception $e){
        $climate->output("Erreur !!!" . $e->getMessage());
        $error = 1;
    }
}


class DivisionBy0Exception extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null){
        if(empty($message)){
            $message = 'Division par 0 impossible';
        }
        parent::__construct($message, $code, $previous);
    }
}

class DivisionWithStrException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null){
        if(empty($message)){
            $message = 'Les deux paramètres doivent être des nombres';
        }
        parent::__construct($message, $code, $previous);
    }
}

class EmptyInputException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null){
        if(empty($message)){
            $message = 'Un ou plusieurs champs sont vides';
        }
        parent::__construct($message, $code, $previous);
    }
}

class IndexToBigException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null){
        if(empty($message)){
            $message = ('Index égal à 0 ou supérieur à ').(count($valeurs) - 1);
        }
        parent::__construct($message, $code, $previous);
    }
}
