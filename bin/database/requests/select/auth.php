<?php

namespace bin\database\requests\select;

use bin\epaphrodite\env\verify_chaine;
use bin\epaphrodite\auth\session_auth;
use \bin\epaphrodite\path\paths;
use bin\epaphrodite\crf_token\csrf_secure;
use bin\database\connexion\processed_request;
use bin\epaphrodite\define\text_messages;
use bin\epaphrodite\env\gestcookies;
use bin\database\requests\insert\if_not_exist;


class auth
{

    private $request;

    /**
     * Get class
     * @return void
    */
    function __construct()
    {

      $this->path = new paths();
      $this->secure = new csrf_secure();
      $this->verify_if_is_correct = new verify_chaine;
      $this->userbd = new session_auth;
      $this->request = new processed_request;
      $this->msg = new text_messages;
      $this->star = new gestcookies();
      $this->if_exist = new if_not_exist;
      
    }

    /**
     * **********************************************************************************************
     * Querybilder constructor
     *
     * @return \bin\database\querybilder\querybuilder
    */    
    private function getclassQueryBuilder(): \bin\database\querybilder\querybuilder
    {
        return new \bin\database\querybilder\querybuilder();
    } 
    
    /**
     * **********************************************************************************************
     * Verify if user_bd table exist in database
     * @return bool
    */
    private function if_table_exist()
    {
      
        try
        {

          $sql = $this->getclassQueryBuilder() 
                      -> table('user_bd') 
                      -> SQuery(NULL);

          $this->request->select_request( $sql , NULL , NULL , false );
          
          return true;
          
        }catch (\Exception $e){

          return false;

        }

    }

    /**
     * **********************************************************************************************
     * Verify if exist in database
     *
     * @param string $loginuser
     * @return void
    */
    public function verify_if_user_exist( string $loginuser )
    {
      
        if($this->if_table_exist()===true)
        {

          $sql = $this->getclassQueryBuilder() 
                      -> table('user_bd') 
                      -> where('loginuser_bd') 
                      -> SQuery(NULL);

          $result = $this->request->select_request($sql,'s',[ $loginuser ] , true );

          return $result;

        }else{

          $this->if_exist->create_table();

          return NULL;

        }

    } 

    /**
     * **********************************************************************************************
     * Verify authentification of user
     *
     * @param string $login
     * @param string $motpasse
     * @return bool
     */
    public function verify_user_access( string $login , string $motpasse )
    {

      if(($this->verify_if_is_correct->only_number_and_character( $login , $nbre=12 ))===false){

            $users_datas = $this->verify_if_user_exist($login);

            if(!empty($users_datas)){

              if (!empty($motpasse)){

                $cryptermdp = hash('gost' , $motpasse );

              }
              
              $hashpassword = $users_datas[0]["mdpuser_bd"];

              $loginPassword = 0;

                if ($cryptermdp===$hashpassword){

                  $loginPassword = 1;
                  
                }

                if ($loginPassword === 1)
                {

                    session_start();
                    
                    $_SESSION["login"] = $users_datas[0]["loginuser_bd"];

                    $_SESSION["id"] = $users_datas[0]["iduser_bd"];

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