<?php

namespace bin\controllers\controllers;

use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Control_admin extends twig
{

    /**
     * declare variables
     *
     * @var \bin\epaphrodite\path\paths $paths
     * @var \bin\epaphrodite\crf_token\token_csrf $csrf
     * @var \bin\epaphrodite\auth\session_auth $auth
     * @var \bin\epaphrodite\define\text_messages $msg
     * @var \bin\epaphrodite\api\sms\send_sms $sms
     * @var \bin\epaphrodite\email\send_mail $mail
     * @var \bin\epaphrodite\env\template $template
     * @var \bin\epaphrodite\env\env $env
     * @var \bin\controllers\render\errors $errors
    */
    private $csrf;
    private $auth;
    private $template;
    private $paths;
    private $sms;
    private $msg;
    private $email;
    private $env;
    private $errors;

    function __construct()
    { 
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf;
        $this->auth = new \bin\epaphrodite\auth\session_auth();
        $this->paths = new \bin\epaphrodite\path\paths();
        $this->msg = new \bin\epaphrodite\define\text_messages; 
        $this->sms = new \bin\epaphrodite\api\sms\send_sms;
        $this->email = new \bin\epaphrodite\api\email\send_mail;       
        $this->env = new \bin\epaphrodite\env\env;
        $this->template = new \bin\epaphrodite\env\template; 
        $this->errors = new errors;
    }

    public function renderphp( $html )
    {

        if(file_exists( _DIR_VIEWS_ . _DIR_ADMIN_TEMP_ . $html . '.html' ))
        {
            
        /**
         * ************************************************************************
         * Dashboard
         * 
         * @param string $html
         * @param array $array
         * @return mixed
        */
        if( $html ==="admin_dashbaord_ep"){

            $this->render( _DIR_ADMIN_TEMP_ . $html ,
            [ 
                'path'=>$this->paths , 
                'env'=>$this->env , 
                'msg' => $this->msg ,
                'template' => $this->template->admin(),
            ]);
            
        }            
                 

        }else{ $this->errors->error_404();}     
    }

}

class admin_controller extends Control_admin
{
    public function send_page( $html ){

        $this->renderphp( $html );
    }
}
