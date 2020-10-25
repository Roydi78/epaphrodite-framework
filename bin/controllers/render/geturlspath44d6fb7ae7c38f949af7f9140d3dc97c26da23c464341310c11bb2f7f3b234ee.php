<?php

namespace bin\controllers\render;


class geturlspath44d6fb7ae7c38f949af7f9140d3dc97c26da23c464341310c11bb2f7f3b234ee
{
    private $path_session;
    private $startsession;
    private $path_interface;
    private $urlfound;
    private $path_router_interface;
    private $path_router_admin;
    private $url;

    /**
     * Get class
     * @return void
    */
    public function __construct()
    {
        $this->startsession = new \bin\epaphrodite\env\gestcookies;
        $this->path_session = new \bin\epaphrodite\auth\session_auth;
        $this->path_interface = new \bin\epaphrodite\others\gestion_interface;
        $this->path_router_interface = new \bin\controllers\controllers\interface_controller;
        $this->path_router_admin = new \bin\controllers\controllers\admin_controller;
        $this->env = new \bin\controllers\render\method44d6fb7ae7c38f949af7f9140d3dc97c26da23c464341310c11bb2f7f3b234ee; 
    }
    
    /**
     * Check and send to controller
     *
     * @var \bin\epaphrodite\env\gestion_interface $path_interface
     * @var \bin\epaphrodite\auth\session_auth $path_session
     * @var string $url
     * @var $this $this
     * @return string
    */ 
    private function geturi()
    {

        if (isset($_GET[ $this->env::GET() ])&&$_GET[ $this->env::GET() ][-1]==="/")
        {
            $this->urlfound = $_GET[ $this->env::GET() ];

        }else{

            $this->urlfound = 'views/index/';
        }
        
        return  str_replace("-","_", $this->urlfound);
    }
    
    
    /* 
        Lancer l'application 
    */
    public function runApp44d6fb7ae7c38f949af7f9140d3dc97c26da23c464341310c11bb2f7f3b234ee()
    {

            $this->url = $this->geturi();

            /**
             * Set cookies and start user session
             * 
             * @param string $lifetime
             * @param string $path
             * @param string $dommaine
             * @param string $secure
             * @param string $httonly
             * @return void
            */ 
            $this->startsession->startsession(60*60*24,'/','',false,true);
        
            /*
                Get user authentification page or destroy session
            */             
            if($this->url === "views/login/"||$this->url === "logout/")
            {  

                $this->path_session->deconnexion();

                $this->url = $this->path_interface->login_interface();  

            }

            /*
                Get user dashbord page
            */ 
            if($this->url=="admin/"&&$this->path_session->token_crf()!==NULL&&$this->path_session->id_user()!==NULL)
            {   
                $this->url = $this->path_interface->gestion_interface_users($this->path_session->id_user());  
            }

        $this->geturls = explode('/',$this->url);
       
        /*
           Return true user page
        */ 
        $this->url = $this->router($this->geturls);
        
    }

    /**
     * Return true controller
     *
     * @param array $recuperationurl
     * @var \bin\controllers\controllers\interface_controller $path_router_interface
     * @var \bin\controllers\controllers\admin_controller $path_router_admin
     * @return string
    */
    private function router($recuperationurl)
    {
        if(count($recuperationurl)>1){ 
            
            $pageenvoyer = $recuperationurl[1].'_ep';

        }else{
            
            $pageenvoyer = 'erreur';
        }

        if($recuperationurl[0]==="views" || $pageenvoyer==="erreur")
        {
            return $this->path_router_interface->send_page($pageenvoyer);

        }elseif($recuperationurl[0]==="admin-views"&&$this->path_session->token_crf()!==NULL&&$this->path_session->id_user()!==NULL){

            return $this->path_router_admin->send_page($pageenvoyer);

        }else{

            return $this->path_router_interface->send_page($pageenvoyer);

        }
    }
    
}