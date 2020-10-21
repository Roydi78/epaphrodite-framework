<?php

namespace bin\controllers\render;
use bin\controllers\render\twig;

class errors extends twig{

    function __construct()
    {
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->messages_path = new \bin\epaphrodite\define\text_messages();
        $this->session = new \bin\epaphrodite\auth\session_auth();        
    }

    /* 
        Page erreur 404
    */    
    public function error_404(){
        echo $this->twig_env()->render('errors/404.html', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        die();
    }

    /* 
        Page erreur 403
    */    
    public function error_403(){
        echo $this->twig_env()->render('errors/403.html', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        die();
    }   
    
    /* 
        Page erreur 419
    */    
    public function error_419(){
        echo $this->twig_env()->render('errors/419.html', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        $this->session->deconnexion();
        die();
    }        

    /* 
        Page erreur 403
    */    
    public function error_500(){
        echo $this->twig_env()->render('errors/500.html', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        die();
    }        

}