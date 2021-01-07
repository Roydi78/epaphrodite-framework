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
        $this->session = new session_auth();
    }

    /**
     * Get session token value
     * 
     * @return void
     */
    private function get_session_token(){

       return $this->token_value->getvalue();

    }  

    /**
     * hidden token csrf input
     * 
     * @return void
    */
    private function get_input_token(){

        if (isset($_POST['token_csrf'])) { return $_POST['token_csrf']; } elseif (isset($_GET['token_csrf'])) { return $_GET['token_csrf']; } else { return NULL; }

     }      

    /**
     * Verify token crsf key
     *
     * @return void
    */
    public function token_verify(){

        if($this->session->login_user()!==NULL){ return $this->on(); }else{ return $this->off(); }

    }

    /**
     * Turn on
     *
     * @return void
     */
    protected function on(){
        if( hash('gost',$this->secure->secure())===hash('gost',$this->get_input_token()) && hash('gost',$this->secure->secure())===hash('gost',$this->get_session_token()) && hash('gost',$this->get_input_token())===hash('gost',$this->get_session_token()) ){ return true; }else{ $this->error->send(); }
    }

    /**
     * Turn off
     *
     * @return void
     */
    protected function off(){
        
        if( hash('gost',$this->get_input_token())===hash('gost',$this->get_session_token()) ){ return true; }else{ $this->error->send(); }
    }


}