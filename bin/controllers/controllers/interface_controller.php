<?php

namespace bin\controllers\controllers;
use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Control extends twig 
{
    /* Gestion des variable du @controlleur */
        protected $crf_token = "";
        private $acces_path;
        private $session_path;
        private $url_path;
        private $errors;

    function __construct()
    {

        $this->acces_path = new \bin\database\requests\select\auth();
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf();
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->msg = new \bin\epaphrodite\define\text_messages();        
        $this->env = new \bin\epaphrodite\env\env(); 
        $this->mail = new \bin\epaphrodite\email\send_mail; 
        $this->errors = new errors;  

    }

    protected function renderphp( $thml )
    {
       
        if(file_exists( _DIR_VIEWS_ . _DIR_MAIN_TEMP_ . $thml . '.html' ))
        {

            $this->answser = NULL;
            
            /* 
                Home page ( index ) 
            */
            if( $thml ==="index_ep")
            {
                $this->render( _DIR_MAIN_TEMP_ . $thml ,
                [ 
                    'path'=>$this->url_path , 
                    'env'=>$this->env , 
                    'messages' => $this->msg
                ]);
            }

            /* 
                Authentification page ( login ) 
            */
            if( $thml ==="login_ep")
            {
                $this->ans='';

                if( isset($_POST['submit'])&&$this->csrf->process()===true ){
                    
                    $this->result = $this->acces_path->verifymember($_POST['login'],$_POST['password']);
                    if($this->result === false){ $this->ans = $this->msg->answers('login-wrong'); }

                }

                $this->render( _DIR_MAIN_TEMP_ . $thml ,
                [ 
                    'path'=>$this->url_path , 
                    'env'=>$this->env , 
                    'messages' => $this->msg,
                    'csrf'=> $this->csrf,
                    'reponse'=>$this->ans,
                ]);
                
            }            
            
        }else{ $this->errors->error_404(); }     
    }

}


class interface_controller extends Control
{
    public function send_page( $thml ){

        $this->renderphp( $thml );

    }

    
}
