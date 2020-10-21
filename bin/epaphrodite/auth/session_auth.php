<?php
namespace bin\epaphrodite\auth;

class session_auth
{
    public $login;
    public $iduser;
    public $token_crf;
    public $nomprenom;
    public $typuser;
    private $_SESSION;

    public function login_user(){
        $this->login = isset($_SESSION['loginuserbd']) ? $_SESSION['loginuserbd'] : NULL;
        return $this->login;
    }

    public function id_user(){
        $this->iduser = isset($_SESSION['iduserbd']) ? $_SESSION['iduserbd'] : NULL;
        return $this->iduser;
    }

    public function token_crf(){
        $this->messages = new \bin\epaphrodite\define\text_messages();
        $token_crf = !empty($_COOKIE[$this->messages->answers('token_name')]) ? $_COOKIE[$this->messages->answers('token_name')] : NULL;
        return $token_crf;
    }

    public function deconnexion(){ 

        if($this->login_user()!==NULL&&$this->id_user()!==NULL){
            session_unset();
                session_destroy(); 
            }
            
    }

}