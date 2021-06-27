<?php

namespace bin\controllers\render;


class geturlspath44d6fb7ae7c38f949af7f9140d3dc97c26da23c464341310c11bb2f7f3b234ee
{
    private $session;
    private $startsession;
    private $interface_manager;
    private $urlfound;
    private $main;
    private $admin;
    private $url;

    /**
     * Get class
     * @return void
    */
    public function __construct()
    {
        $this->startsession = new \bin\epaphrodite\env\gestcookies;
        $this->session = new \bin\epaphrodite\auth\session_auth;
        $this->interface_manager = new \bin\epaphrodite\others\gestion_interface;
        $this->main = new \bin\controllers\controllers\main;
        $this->admin = new \bin\controllers\controllers\admin;
        $this->env = new \bin\controllers\render\method44d6fb7ae7c38f949af7f9140d3dc97c26da23c464341310c11bb2f7f3b234ee; 
        $this->path_url = new \bin\epaphrodite\path\paths;
    }
    
    /**
     * Check and send to controller
     *
     * @var \bin\epaphrodite\env\gestion_interface $interface_manager
     * @var \bin\epaphrodite\auth\session_auth $session
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
        
        return  $this->path_url->href_slug($this->urlfound);
        
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

                $this->session->deconnexion();

                $this->url = $this->interface_manager->login();  

            }

            /*
                Get user dashbord page
            */ 
            if($this->session->token_csrf()!==NULL&&$this->session->id()!==NULL&&$this->session->login()!==NULL)
            {   

                $this->url = $this->interface_manager->admin( $this->session->type() , $this->url);  
                
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
     * @param array $get_url
     * @var \bin\controllers\controllers\main $main
     * @var \bin\controllers\controllers\admin $admin
     * @return string
    */
    private function router($get_url)
    {
        if(count($get_url)>1){ 
            
            $main = $get_url[1].'_ep';
            $admin = $get_url[1].'/'.$get_url[2].'_ep';

        }else{
            
            $page = 'erreur';
        }

        if($get_url[0]==="views" || $main==="erreur")
        {
            return $this->main->send($main);

        }elseif($get_url[0]==="admin_views"&&$this->session->token_csrf()!==NULL&&$this->session->id()!==NULL&&$this->session->login()!==NULL){
            
            return $this->admin->send($admin);

        }else{

            return $this->main->send($main);

        }
    }
    
}