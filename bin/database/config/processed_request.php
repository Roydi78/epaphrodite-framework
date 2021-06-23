<?php

namespace bin\database\config;

use bin\database\config\database;

class processed_request
{

    *
    /**
     * *****************************************************************************************************************************
     * Processed all select request
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */
    public function select_request( $sql, ?string $Parametre=null , ?array $datasparam = null , ?bool $etat=false ){

        $result = $this->connexion()->select($sql, $Parametre, $datasparam);
        
        if($etat===true){ $this->connexion->closeConnection(); }

        return $result;

    }

    /**
     * *****************************************************************************************************************************
     * Processed all update request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
    */  
    public function update_request( $sql , ?string $Parametre=null , ?array $datasparam = null , ?bool $etat = false ){

        $result = $this->connexion()->update($sql, $Parametre, $datasparam);

        if($etat===true){ $this->connexion->closeConnection(); }

        return $result;

    }  
    
    /**
     * *****************************************************************************************************************************
     * Processed all insert request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */   
    public function insert_request( $sql , ?string $Parametre = null , ?array $datasparam = null , ?bool $etat = false ){

        $result = $this->connexion()->insert($sql, $Parametre, $datasparam);

        if($etat===true){ $this->connexion->closeConnection(); }

        return $result;

    }    
    
    /**
     * *****************************************************************************************************************************
     * Processed all delete request
     *
     * @param string $sql
     * @param string|null $Parametre
     * @param array|null $datasparam
     * @param boolean|null $etat
     * @return void
     */    
    public function delete_request( $sql , ?string $Parametre = null , ?array $datasparam = null , ?bool $etat = false ){

        $result = $this->connexion()->delete($sql, $Parametre, $datasparam);

        if($etat===true){ $this->connexion->closeConnection(); }

        return $result;
        
    } 
    
    /**
     * *****************************************************************************************************************************
     * Get connexion of database
     */     
    private function connexion(){

     return $this->connexion = new database();

    }
    
}