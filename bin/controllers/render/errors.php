<?php

namespace bin\controllers\render;
use bin\controllers\render\twig;

class errors extends twig{

    /**
     * Get class
     * @return void
    */
    function __construct()
    {
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->messages_path = new \bin\epaphrodite\define\text_messages();
        $this->session = new \bin\epaphrodite\auth\session_auth();        
    }

    /**
     * Page erreur 404
     *
     * @return exit
    */   
    public function error_404(){

        $this->render('errors/404', 
        [ 

            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,

        ]);
        die();
    }

    /**
     * Page erreur 403
     *
     * @return exit
     */   
    public function error_403(){
        $this->render('errors/403', 
        [ 

            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,

        ]);
        die();
    }   
    
    /**
     * Page erreur 419 
     *
     * @return exit
     */  
    public function error_419(){

        $this->render('errors/419', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        $this->session->deconnexion();
        die();

    }        

    /**
     * Page erreur 500
     * 
     * @return exit
    */    
    public function error_500(){

        $this->render('errors', 
        [ 
            'path'=>$this->url_path ,
            'messages' => $this->messages_path ,
        ]);
        die();

    }        

}