<?php

namespace bin\database\connexion;
use bin\database\connexion\database;

class processed_request
{

    /* 
      Get database connexion class
    */    
    function __construct()
    {
      $this->connexion = new database();
    }

    /* 
      Processed all select request
    */    
    public function select_request( $sql, $Parametre , $datasparam = array() , $etat ){

        $result = $this->connexion->select($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;

    }

    /* 
      Processed all update request
    */    
    public function update_request($sql, $Parametre, $datasparam = array() , $etat ){

        $result = $this->connexion->update($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;

    }  
    
    /* 
      Processed all insert request
    */    
    public function insert_request($sql, $Parametre, $datasparam = array(), $etat ){

        $result = $this->connexion->insert($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;

    }    
    
    /* 
      Processed all delete request
    */    
    public function delete_request($sql, $Parametre, $datasparam = array() , $etat ){

        $result = $this->connexion->delete($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;
        
    }      
    
}