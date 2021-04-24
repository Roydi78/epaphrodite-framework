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
     * @var \bin\database\requests\select\auth $acces_path
     * @var \bin\epaphrodite\env\template $template
    */
    private $csrf;
    private $acces_path;
    private $template;
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

        $this->acces_path = new \bin\database\requests\select\auth();
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf();
        $this->paths = new \bin\epaphrodite\path\paths();
        $this->msg = new \bin\epaphrodite\define\text_messages();        
        $this->env = new \bin\epaphrodite\env\env();
        $this->template = new \bin\epaphrodite\env\template();
        $this->sms = new \bin\epaphrodite\api\sms\send_sms;
        $this->email = new \bin\epaphrodite\api\email\send_mail;
        $this->errors = new errors;  

    }


    protected function renderphp( $html )
    {

        if(file_exists( _DIR_VIEWS_ . _DIR_MAIN_TEMP_ . $html . '.html' ))
        {

            $this->answser = NULL;
            
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
                    'template' => $this->template->default(),
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
                $this->ans='';

                if( isset($_POST['submit'])&&$this->csrf->process()===true ){
                    
                    $this->result = $this->acces_path->verifymember($_POST['login'],$_POST['password']);

                    if($this->result === false){ $this->ans = $this->msg->answers('login-wrong'); }

                }

                $this->render( _DIR_MAIN_TEMP_ . $html ,
                [ 
                    'path'=>$this->paths , 
                    'env'=>$this->env , 
                    'msg' => $this->msg,
                    'csrf'=> $this->csrf,
                    'reponse'=>$this->ans,
                    'template' => $this->template->default(),
                ]);
                
            }else{ $this->errors->error_404(); }          
            
        }else{ $this->errors->error_404(); }     
    }

}


class interface_controller extends Control
{
    public function send_page( $html )
    {

        $this->renderphp( $html );

    }

    
}
