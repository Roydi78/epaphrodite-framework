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
        $this->messages_path = new \bin\epaphrodite\define\text_messages();        
        $this->env = new \bin\epaphrodite\env\environement(); 
        $this->errors = new errors;       
    }

    protected function renderphp($view)
    {
       
        
        if(file_exists( _DIR_VIEWS_ . '/main/'.$view.'.html'))
        {
            
        /* 
            Home page ( index ) 
        */
            if($view==="index_ep"){
                echo $this->twig_env()->render('main/'.$view.'.html',
                [ 
                    'path'=>$this->url_path , 
                    'env'=>$this->env , 
                    'messages' => $this->messages_path
                ]);
            }

        /* 
            Authentification page ( login ) 
        */
        if($view==="login_ep"){

            $this->answser = NULL;

            if( isset($_POST['submit'])&&$this->csrf->process()===true ){
                
                $this->result = $this->acces_path->verifymember($_POST['login'],$_POST['password']);
                if($this->result === false){ $this->answser = $this->messages_path->answers('login-wrong'); }

            }

            echo $this->twig_env()->render('main/'.$view.'.html',
            [ 
                'path'=>$this->url_path , 
                'env'=>$this->env , 
                'messages' => $this->messages_path,
                'csrf'=> $this->csrf,
                'reponse'=>$this->answser,
            ]);
        }            
            
        }else{ $this->errors->error_404(); }     
    }

}


class interface_controller extends Control
{
    public function send_page($view){

        $this->renderphp($view);

    }

    
}
