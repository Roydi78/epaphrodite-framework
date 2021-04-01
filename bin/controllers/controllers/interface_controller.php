<?php

namespace bin\controllers\controllers;
use bin\controllers\render\twig;
use bin\controllers\render\errors;

class Control extends twig 
{
    /**
     * declare variables
     *
     * @var \bin\epaphrodite\path\paths $url_path
     * @var \bin\epaphrodite\crf_token\token_csrf $csrf
     * @var \bin\epaphrodite\auth\session_auth $path_session
     * @var \bin\epaphrodite\define\text_messages $msg
     * @var \bin\epaphrodite\email\send_mail $mail
     * @var \bin\controllers\render\errors $errors
     * @var \bin\database\requests\select\auth $acces_path
     * @var \bin\epaphrodite\env\template $template
    */
    private $csrf;
    private $acces_path;
    private $template;
    private $url_path;
    private $msg;
    private $env;
    private $errors;

    /**
     * Get class
    */    
    function __construct()
    {

        $this->acces_path = new \bin\database\requests\select\auth();
        $this->csrf = new \bin\epaphrodite\crf_token\token_csrf();
        $this->url_path = new \bin\epaphrodite\path\paths();
        $this->msg = new \bin\epaphrodite\define\text_messages();        
        $this->env = new \bin\epaphrodite\env\env();
        $this->template = new \bin\epaphrodite\env\template();
        $this->sms = new \bin\epaphrodite\api\send_sms;
        $this->errors = new errors;  

    }


    protected function renderphp( $thml )
    {

        if(file_exists( _DIR_VIEWS_ . _DIR_MAIN_TEMP_ . $thml . '.html' ))
        {

            $this->answser = NULL;
            
            /**
             * index du site
             * 
             * @param string $html
             * @param array $array
             * @return mixed
            */
            if( $thml ==="index_ep")
            {
                $this->render( _DIR_MAIN_TEMP_ . $thml ,
                [ 
                    'path'=>$this->url_path , 
                    'env'=>$this->env , 
                    'msg' => $this->msg
                ]);
            }

            /**
             * Authentification page ( login )
             * 
             * @param string $html
             * @param array $array
             * @return mixed
            */
            elseif( $thml ==="login_ep")
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
                    'msg' => $this->msg,
                    'csrf'=> $this->csrf,
                    'reponse'=>$this->ans,
                ]);
                
            }else{ $this->errors->error_404(); }          
            
        }else{ $this->errors->error_404(); }     
    }

}


class interface_controller extends Control
{
    public function send_page( $thml ){

        $this->renderphp( $thml );

    }

    
}
