<?php

namespace bin\database\requests\insert;

use \bin\database\connexion\processed_request;

class if_not_exist{

    /**
     * Get class
     * @return void
    */   
    function __construct()
    {
      $this->request = new processed_request;
    } 

    /* 
      Creation de la table auth_secure
    */
    private function create_auth_secure_if_not_exist()
    {

      $sql = "CREATE TABLE IF NOT EXISTS auth_secure (idtoken_secure int(11) NOT NULL auto_increment , auth varchar(300)NOT NULL , auth_key varchar(300)NOT NULL , PRIMARY KEY(idtoken_secure) )";        

      $this->request->insert_request( $sql , NULL , NULL , false );

    }  
    
    /* 
      Creation de la table user
    */
    private function create_user_if_not_exist()
    {

      $sql = "CREATE TABLE IF NOT EXISTS user_bd (iduser_bd int(11) NOT NULL auto_increment , loginuser_bd varchar(200)NOT NULL , mdpuser_bd varchar(500)NOT NULL , PRIMARY KEY(iduser_bd) )";        

      $this->request->insert_request( $sql , NULL , NULL , false );

    }   
    
    /* 
      Verifier l'existence des tables user et auth_secure
    */    
    public function create_table()
    {
        
        $this->create_user_if_not_exist();
        $this->create_auth_secure_if_not_exist();

    }


}