<?php
namespace bin\epaphrodite\auth;

class session_auth
{
    protected $login;
    protected $id;
    protected $type;
    protected $token_csrf;


    /**
     * ***************************************************************************************************
     * User session login data
     * @var mixed $login
     * @return mixed
    */    
    public function login(){

        $this->login = isset($_SESSION['login']) ? $_SESSION['login'] : NULL;

        return $this->login;

    }

    /**
     * ***************************************************************************************************
     * User session iduser data
     * @var int $iduser
     * @return mixed
    */     
    public function id(){

        $this->id = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;

        return $this->id;

    }

    /**
     * ***************************************************************************************************
     * User session type user
     * @var int $type
     * @return mixed
    */     
    public function type(){

        $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : NULL;

        return $this->type;

    }    

    /**
     * ***************************************************************************************************
     * User cookies token_csrf data
     * @var mixed $token_csrf
     * @return mixed
    */      
    public function token_csrf(){

        $this->messages = new \bin\epaphrodite\define\text_messages();

        $token_csrf = !empty($_COOKIE[$this->messages->answers('token_name')]) ? $_COOKIE[$this->messages->answers('token_name')] : NULL;
        
        return $token_csrf;

    }

    /**
     * ***************************************************************************************************
     * Destroy user session
     * @return mixed
    */     
    public function deconnexion(){ 

        if($this->login()!==NULL&&$this->id()!==NULL){

            session_unset();

                session_destroy(); 

            }
            
    }

}