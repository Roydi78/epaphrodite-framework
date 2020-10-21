<?php

namespace bin\controllers\controllers;

use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Controladmin extends twig
{
    /* Gestion des variable du @controlleur */
    protected $crf_token = "";
    private $acces_path;
    private $session_path;
    private $url_path;
    private $loader;
    private $twig;

    function __construct()
    { 
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf();
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->messages_path = new \bin\epaphrodite\define\text_messages();        
        $this->env = new \bin\epaphrodite\env\environement(); 
        $this->errors = new errors;
    }

    public function renderphp($view)
    {

        if(file_exists( _DIR_VIEWS_ . '/admin/'.$view.'.html' ))
        {
            
        /* 
            Dashbaord
        */
        if($view==="admin-dashbaord_ep"){
            echo $this->twig_env()->render('admin/'.$view.'.html',
            [ 
                'path'=>$this->url_path , 
                'env'=>$this->env , 
                'messages' => $this->messages_path
            ]);
        }            
                 

        }else{ $this->errors->error_404();}     
    }

}

class admin_controller extends Controladmin
{
    public function send_page($view){

        $this->renderphp($view);
    }
}
