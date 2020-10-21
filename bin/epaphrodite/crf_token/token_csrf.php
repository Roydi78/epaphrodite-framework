<?php

namespace bin\epaphrodite\crf_token;

use bin\epaphrodite\crf_token\gettokenvalue;
use bin\epaphrodite\crf_token\validate_token;

class token_csrf{

    protected $token_value;

    function __construct()
    {

        $this->token_value = new gettokenvalue();

        $this->crsf = new validate_token();

    }

    public function input_field(){

        $input_token = "<input type='hidden' name='token_csrf' value='".$this->token_value->getvalue()."' required \>";

        echo $input_token;
    }  

    public function process(){

        return $this->crsf->token_verify();

    }

}