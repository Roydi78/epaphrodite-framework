<?php

namespace bin\database\requests\select;

use bin\database\config\process;

class get_id
{

    /**
     * Get class
     * @return void
    */
    function __construct()
    {
        $this->process = new process;
        $this->datas = new \bin\database\datas\datas;
        $this->session = new \bin\epaphrodite\auth\session_auth;
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

    /** **********************************************************************************************
     * Request to select users by login
     *
     * @param string|null $kecodey
     * @return array
    */    
    public function get_infos_users_by_code( ?string $login=null )
    {

        $sql = $this->QueryBuilder()
            ->table('user_bd')
            ->where('loginuser_bd')
            ->SQuery(NULL);

        $result = $this->process->select($sql, 's', [ $login ], false);

        return $result;
    } 

}