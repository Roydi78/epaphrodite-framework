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

    /**
    * Ajouter des droits utilisateurs
    *
    * @param int|null $idtype_users
    * @param string|null $pages
    * @param string|null $actions
    * @return bool
    */ 
    public function users_rights( ?int $idtype_users=null , ?string $pages=null ,  ?string  $actions=null )
    {
       
        if (!empty($idtype_users) && !empty($pages) && count($this->get_id->if_right_exist($idtype_users, $pages)) < 1) {
                
            $sql = $this->QueryBuilder()
                        ->table('user_rights')
                        ->insert(' idtype_user_rights , idpages , autorisations , modules , menus ')
                        ->values(' ? , ? , ? , ? , ? ')
                        ->IQuery();
                
            $this->process->insert($sql, 'sss', [ $idtype_users , $pages , $actions , $this->datas->yedidiah($pages,'apps') , $this->datas->yedidiah($pages,'apps').','.$idtype_users ], false);
                
            return true;
        } else {
            return false;
        }

    }  

    /**
    * Ajouter des droits utilisateurs dans le systeme
    *
    * @param string|null $login
    * @param int|null $idtype
    * @return bool
    */ 
    public function add_users( ?string $login=null , ?int $idtype=null )
    {
        
        if (!empty($login) && !empty($idtype) && count($this->get_id->get_infos_users_by_login($login)) < 1) {
                
            $sql = $this->QueryBuilder()
                        ->table('user_bd')
                        ->insert(' loginuser_bd , mdpuser_bd , type_user_bd ')
                        ->values(' ? , ? , ? ')
                        ->IQuery();
                
            $this->process->insert($sql, 'sss', [ $this->env->no_space($login) , hash('gost', $login.'@epaphrodite@'.$login), $idtype  ], false);
                
            return true;
        } else {
            return false;
        }

    }    


}