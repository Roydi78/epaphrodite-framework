<?php

namespace bin\database\requests\select;
use bin\epaphrodite\env\verify_chaine;
use bin\epaphrodite\auth\session_auth;
use \bin\epaphrodite\path\paths;
use \bin\database\connexion\processed_request;


class auth
{

    private $connexion;
    private $request;

    /* 
      Get class 
    */
    function __construct()
    {
      $this->path = new paths();
      $this->verify_if_is_correct = new verify_chaine;
      $this->userbd = new session_auth;
      $this->request = new processed_request;
      
    }

    /* 
      Get class of select query builder
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
                    -> table('userdatabase')                     
                    -> where('logindspsuserbd') 
                    -> SQuery(NULL);   
                            
      $result = $this->request->select_request($sql,'s',[ $loginuser ],true);
      return $result;
    } 

    /* 
      Verify authentification of user
    */
    public function verifymember($login,$motpasse)
    {
      
      if(($this->verify_if_is_correct->only_number_and_character($login,$nbre=12))===false){

            $loginUserResult = $this->verifiersiexite($login);
            if(!empty($loginUserResult)){
              if (!empty($motpasse)){
                $cryptermdp = hash('gost',$motpasse);
              }
              
              $hashpassword = $loginUserResult[0]["mdpdspsbd"];
              $loginPassword = 0;

                if ($cryptermdp===$hashpassword){
                  $loginPassword = 1;
                }

                if ($loginPassword === 1)
                {
                    session_start();
                    $_SESSION["loginuserbd"] = $loginUserResult[0]["logindspsuserbd"];
                    $_SESSION["iduserbd"] = $loginUserResult[0]["iduserdatabase"];

                    $this->getdashboard = $this->path->dashboard('admin/');
                    header("Location: $this->getdashboard ");

                } else if ($loginPassword == 0) {return false;}
            }else{return false;}
        }else{return false;}
    }

}