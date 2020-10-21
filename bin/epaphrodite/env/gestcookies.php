<?php

namespace bin\epaphrodite\env;

class gestcookies
{
    protected $pathvalue;
    protected $cookievalue;
    protected $initvalue = "";
    private $path_session;
    
    public function startsession($lifetime, $path, $dommaine, $secure, $httonly)
    {
        $this->pathvalue = new \bin\epaphrodite\crf_token\gettokenvalue();
        $this->path_session = new \bin\epaphrodite\auth\session_auth();
        $this->messages = new \bin\epaphrodite\define\text_messages();

        $this->cookievalue = $this->pathvalue->getvalue($this->initvalue);
        
        session_set_cookie_params($lifetime, $path, $dommaine, $secure, $httonly);

        session_name($this->messages->answers('session_name'));

        session_start();

        if($this->path_session->login_user()===NULL&&empty($this->path_session->token_crf()))
        {
            setcookie($this->messages->answers('token_name'), $this->cookievalue , time()+60*60*24 , $path , $dommaine , $secure , $httonly);

            $_COOKIE[$this->messages->answers('token_name')] = $this->cookievalue;
            
        }
     }
}