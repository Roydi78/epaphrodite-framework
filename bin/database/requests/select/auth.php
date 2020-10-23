<?php

namespace bin\database\requests\select;

use bin\epaphrodite\env\verify_chaine;
use bin\epaphrodite\auth\session_auth;
use \bin\epaphrodite\path\paths;
use bin\epaphrodite\crf_token\csrf_secure;
use \bin\database\connexion\processed_request;
use bin\epaphrodite\define\text_messages;


class auth
{

    private $request;

    /* 
      Get class 
    */
    function __construct()
    {
      $this->path = new paths();
      $this->secure = new csrf_secure();
      $this->verify_if_is_correct = new verify_chaine;
      $this->userbd = new session_auth;
      $this->request = new processed_request;
      $this->msg = new text_messages;
      $this->star = new \bin\epaphrodite\env\gestcookies();
      
    }

    /**
     * Recuperation des parametres d'execution d'une requete sql
    */   
    private function getclassQueryBuilder(): \bin\database\querybilder\querybuilder
    {
        return new \bin\database\querybilder\querybuilder();
    }    

    /* 
      Verify if exist in database
    */
    public function verifiersiexite($loginuser)
    {

      $sql = $this->getclassQueryBuilder() 
                    -> table('userpme_bd') 
                    -> where('loginuser_bd') 
                    -> SQuery(NULL);
      $result = $this->request->select_request($sql,'s',[ $loginuser ] , true);

      return $result;

    } 

    /* 
      Verify authentification of user
    */
    public function verifymember( $login , $motpasse )
    {

      if(($this->verify_if_is_correct->only_number_and_character( $login , $nbre=12 ))===false){

            $loginUserResult = $this->verifiersiexite($login);

            if(!empty($loginUserResult)){

              if (!empty($motpasse)){

                $cryptermdp = hash('gost',$motpasse);

              }
              
              $hashpassword = $loginUserResult[0]["mdpuser_bd"];

              $loginPassword = 0;

                if ($cryptermdp===$hashpassword){

                  $loginPassword = 1;
                  
                }

                if ($loginPassword === 1)
                {

                    session_start();
                    
                    $_SESSION["loginuserbd"] = $loginUserResult[0]["loginuser_bd"];

                    $_SESSION["iduserbd"] = $loginUserResult[0]["iduserpme_bd"];

                    $this->gethost = $this->path->sad_link('admin');

                    if($this->secure->get_csrf($_COOKIE[$this->msg->answers('token_name')])!==0)
                    {

                      $this->star->set_user_cookies( '/' , '' , false , true , $this->secure->secure() );

                    }                    

                    header("Location: $this->gethost ");

                } else if ($loginPassword == 0) {return false;}

            }else{return false;}

        }else{return false;}
    }

}