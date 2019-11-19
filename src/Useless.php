<?php

namespace Ipssi\Evaluation;

class DivisionBy0Exception extends Exception
{
    public function __construct($message = "", $code = 0, Exception $previous = null){
        if(empty($message)){
            $message = 'Division par 0 impossible';
        }
        parent::__construct($message, $code, $previous);
    }
}
