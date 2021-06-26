<?php

namespace bin\database\requests\delete;

use bin\database\config\process;

class delete{

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
     * Request to delete all users of database
    */
    public function users(){

        $sql = $this->QueryBuilder() 
                    -> table('user_bd') 
                    -> DQuery(NULL);

        $result = $this->process->delete_process( $sql , null , null , true );

        return $result;        

    }    




}