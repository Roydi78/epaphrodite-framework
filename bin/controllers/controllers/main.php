<?php

namespace bin\controllers\controllers;

use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Control extends twig 
{
    /**
     * *****************************************************************************************************************************
     * declare all variables
     *
     * @var \bin\epaphrodite\path\paths $paths
     * @var \bin\epaphrodite\crf_token\token_csrf $csrf
     * @var \bin\epaphrodite\auth\session_auth $path_session
     * @var \bin\epaphrodite\define\text_messages $msg
     * @var \bin\epaphrodite\email\send_mail $email
     * @var \bin\epaphrodite\api\sms\send_sms $sms
     * @var \bin\controllers\render\errors $errors
     * @var \bin\database\requests\select\auth $loginin
     * @var \bin\epaphrodite\env\layouts $layouts
    */
    private $csrf;
    private $loginin;
    private $layouts;
    private $paths;
    private $email;
    private $sms;
    private $env;
    private $msg;
    private $errors;

    /**
     * *****************************************************************************************************************************
     * Get class
    */    
    function __construct()
    {

        $this->errors = new errors;  
        $this->env = new \bin\epaphrodite\env\env;
        $this->paths = new \bin\epaphrodite\path\paths;
        $this->layouts = new \bin\epaphrodite\env\layouts;
        $this->sms = new \bin\epaphrodite\api\sms\send_sms;
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf;
        $this->loginin = new \bin\database\requests\select\auth;
        $this->session = new \bin\epaphrodite\auth\session_auth;
        $this->msg = new \bin\epaphrodite\define\text_messages;        
        $this->email = new \bin\epaphrodite\api\email\send_mail;

    }


    protected function epaphrodite( $html )
    {
        

        if(file_exists( _DIR_VIEWS_ . _DIR_MAIN_TEMP_ . $html . '.html' ))
        {
            /**
             * *****************************************************************************************************************************
             * index
             * 
             * @param string $html
             * @param array $array
             * @return mixed
            */
            if( $html ==="index_ep")
            {
                $this->render( _DIR_MAIN_TEMP_ . $html ,
                [ 
                    'path' => $this->paths , 
                    'env' => $this->env , 
                    'msg' => $this->msg ,
                    'layouts' => $this->layouts->main(),
                ]);
            }

            /**
             * *****************************************************************************************************************************
             * Authentification page ( login )
             * 
             * @param string $html
             * @param array $array
             * @return mixed
            */
            elseif( $html ==="login_ep")
            {
            
                $this->ans='';$class=null;

                if( isset($_POST['submit'])&&$this->csrf->process()===true ){
                    
                    $this->result = $this->loginin->acces_manager( $_POST['login'] , $_POST['password'] );
                    if($this->result === false){ $this->ans = $this->msg->answers('login-wrong'); $class="error"; }

                }

                $this->render( _DIR_MAIN_TEMP_ . $html ,
                [ 
                    'path'=>$this->paths , 
                    'env'=>$this->env , 
                    'msg' => $this->msg,
                    'csrf'=> $this->csrf,
                    'reponse'=>$this->ans,
                    'class'=>$class,
                    'layouts' => $this->layouts->main(),
                    'form' => $this->layouts->forms(),
                ]);
                
            }else{ $this->errors->error_404(); }          
            
        }else{ $this->errors->error_404(); }  

    }

}


class main extends Control
{
    public function send( $html )
    {

        $this->epaphrodite( $html );

    }

    
}
