<?php

namespace bin\database\requests\insert;

use bin\database\config\process;

class insert{

    /**
     * Get class
     * @return void
    */
    function __construct()
    {
      $this->process = new process;
    }      

    /************************************************************************************************
     * Querybilder constructor
     *
     * @return \bin\database\querybilder\querybuilder
    */    
    private function QueryBuilder(): \bin\database\querybilder\querybuilder
    {
        return new \bin\database\querybilder\querybuilder();
    }     

    /************************************************************************************************
     * Request to select all users of database
    */
    public function users(){

        $sql = $this->QueryBuilder() 
                    -> table('user_bd') 
                    -> IQuery(NULL);

        $result = $this->process->insert( $sql , null , null , true );

        return $result;        

    }   




}