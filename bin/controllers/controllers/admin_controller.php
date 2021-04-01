<?php

namespace bin\controllers\controllers;

use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Controladmin extends twig
{
    /* Gestion des variable du @controlleur */
    private $url_path;

    function __construct()
    { 
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf();
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->messages_path = new \bin\epaphrodite\define\text_messages(); 
        $this->mail = new \bin\epaphrodite\email\send_mail;        
        $this->env = new \bin\epaphrodite\env\env(); 
        $this->errors = new errors;
    }

    public function renderphp( $html )
    {

        if(file_exists( _DIR_VIEWS_ . _DIR_ADMIN_TEMP_ . $html . '.html' ))
        {
            
        /**
         * Dashboard
         * 
         * @param string $html
         * @param array $array
         * @return mixed
        */
        if( $html ==="admin-dashbaord_ep"){

            $this->render( _DIR_ADMIN_TEMP_ . $html ,
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
    public function send_page( $html ){

        $this->renderphp( $html );
    }
}
