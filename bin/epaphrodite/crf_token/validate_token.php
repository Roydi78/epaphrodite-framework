<?php

namespace bin\epaphrodite\crf_token;

use bin\epaphrodite\crf_token\gettokenvalue;
use bin\epaphrodite\crf_token\token_error;

class validate_token{

    protected $token_value;

    function __construct()
    {

        $this->token_value = new gettokenvalue();

        $this->error = new token_error();

    }

    private function get_session_token(){

       return $this->token_value->getvalue();

    }  

    private function get_input_token(){

        return isset($_POST['token_csrf']) ? $_POST['token_csrf'] : NULL;  

     }      

    public function token_verify(){

        if(hash('gost',$this->get_session_token())!==hash('gost',$this->get_input_token())){ $this->error->send(); }else{ return true;}

    }



}