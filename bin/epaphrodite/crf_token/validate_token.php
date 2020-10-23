<?php

namespace bin\epaphrodite\crf_token;

use bin\epaphrodite\crf_token\gettokenvalue;
use bin\epaphrodite\crf_token\token_error;
use bin\epaphrodite\crf_token\csrf_secure;
use bin\epaphrodite\auth\session_auth;

class validate_token {

    protected $token_value;

    /**
     * construct class
     * @return void
     */
    function __construct()
    {
        $this->token_value = new gettokenvalue();
        $this->error = new token_error();
        $this->secure = new csrf_secure();
        $this->userbd = new session_auth();
    }

    /**
     * Get session token value
     * @return void
     */
    private function get_session_token(){

       return $this->token_value->getvalue();

    }  

    /**
     * Input token
     * @return void
     */
    private function get_input_token(){

        return isset($_POST['token_csrf']) ? $_POST['token_csrf'] : NULL;  

     }      

    public function token_verify(){

        if($this->userbd->login_user()!==NULL){ return $this->on(); }else{ return $this->off(); }

    }

    protected function on(){
        if( hash('gost',$this->secure->secure())===hash('gost',$this->get_input_token()) && hash('gost',$this->secure->secure())===hash('gost',$this->get_session_token()) && hash('gost',$this->get_input_token())===hash('gost',$this->get_session_token()) ){ return true; }else{ $this->error->send(); }
    }

    protected function off(){
        
        if( hash('gost',$this->get_input_token())===hash('gost',$this->get_session_token()) ){ return true; }else{ $this->error->send(); }
    }


}