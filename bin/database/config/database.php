<?php

namespace bin\database\config;

use PDO;
use bin\database\config\config;

class database extends config
{
    /*
        @Var of connexions 
    */

    /* 
        Construct database connection 
    */
    public function get_connexion($db)
    {
        return $this->epaphrodite_get_connexion($db);
    }

    /* 
        Disconnexion 
    */
    public function closeConnection($bd)
    {
       return $this->epaphrodite_get_connexion($bd) = NULL;
    }

    /* 
        SQL select request  
    */
    public function select($sql_chaine, $param, $datas = array() , int $bd)
    {
        
        $request = $this->get_connexion($bd)->prepare($sql_chaine);

        if (!empty($param)) {

            foreach ($datas as $k => &$v) {
                $request->bindParam($k + 1, $datas[$k], PDO::PARAM_STR);
            }
        }

        $request->execute();

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
        SQL insert request  
    */
    public function insert($sql_chaine, $param, $datas = array() , int $db)
    {

        $request = $this->get_connexion($db)->prepare($sql_chaine);

        if (!empty($param)) {

            foreach ($datas as $k => &$v) {
                $request->bindParam($k + 1, $datas[$k], PDO::PARAM_STR);
            }
        }

        $result = $request->execute();

        return $result;
    }

    /* 
        SQL delete request  
    */
    public function delete($sql_chaine, $param, $datas = array() , int $db)
    {
        $request = $this->get_connexion($db)->prepare($sql_chaine);

        if (!empty($param)) {

            foreach ($datas as $k => &$v) {
                $request->bindParam($k + 1, $datas[$k], PDO::PARAM_STR);
            }
        }

        $request = $request->execute();

        return $request;
    }

    /* 
        SQL update request 
    */
    public function update($sql_chaine, $param, $datas = array() , int $db)
    {
        $request = $this->get_connexion($db)->prepare($sql_chaine);

        if (!empty($param)) {

            foreach ($datas as $k => &$v) {
                $request->bindParam($k + 1, $datas[$k], PDO::PARAM_STR);
            }
        }

        $result = $request->execute();

        return $result;
    }
}
