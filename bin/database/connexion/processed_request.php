<?php

namespace bin\database\connexion;
use bin\database\connexion\database;

class processed_request
{


    /**
     * Processed all select request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */
    public function select_request( string $sql, ?string $Parametre=null , ?array $datasparam = null , ?bool $etat=false ){
      $this->connexion = new database();
        $result = $this->connexion->select($sql, $Parametre, $datasparam);
        if($etat===true){
          $this->connexion->closeConnection(); }
        return $result;

    }

    /**
     * Processed all update request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
    */  
    public function update_request( string $sql , ?string $Parametre=null , ?array $datasparam = null , ?bool $etat = false ){
      $this->connexion = new database();
        $result = $this->connexion->update($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;

    }  
    
    /**
     * Processed all insert request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */   
    public function insert_request( string $sql , ?string $Parametre = null , ?array $datasparam = null , ?bool $etat = false ){
      $this->connexion = new database();
        $result = $this->connexion->insert($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;

    }    
    
    /**
     * Processed all delete request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */    
    public function delete_request( string $sql , ?string $Parametre = null , ?array $datasparam = null , ?bool $etat = false ){
      $this->connexion = new database();
        $result = $this->connexion->delete($sql, $Parametre, $datasparam);
        if($etat===true){ $this->connexion->closeConnection(); }
        return $result;
        
    }      
    
}