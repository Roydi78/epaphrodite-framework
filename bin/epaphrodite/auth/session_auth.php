<?php
namespace bin\epaphrodite\auth;

class session_auth
{
    public $login;
    public $iduser;
    public $token_crf;
    public $typuser;


    /**
     * ***************************************************************************************************
     * User session login data
     * @var mixed $login
     * @return mixed
    */    
    public function login_user(){

        $this->login = isset($_SESSION['loginuserbd']) ? $_SESSION['loginuserbd'] : NULL;

        return $this->login;

    }

    /**
     * ***************************************************************************************************
     * User session iduser data
     * @var mixed $iduser
     * @return mixed
    */     
    public function id_user(){

        $this->iduser = isset($_SESSION['iduserbd']) ? $_SESSION['iduserbd'] : NULL;

        return $this->iduser;

    }

    /**
     * ***************************************************************************************************
     * User cookies token_crf data
     * @var mixed $token_crf
     * @return mixed
    */      
    public function token_crf(){

        $this->messages = new \bin\epaphrodite\define\text_messages();

        $token_crf = !empty($_COOKIE[$this->messages->answers('token_name')]) ? $_COOKIE[$this->messages->answers('token_name')] : NULL;
        
        return $token_crf;

    }

    /**
     * ***************************************************************************************************
     * Destroy user session
     * @return mixed
    */     
    public function deconnexion(){ 

        if($this->login_user()!==NULL&&$this->id_user()!==NULL){

            session_unset();

                session_destroy(); 

            }
            
    }

}