<?php

namespace bin\database\config;

use PDO;
use PDOException;

class database
{
    /*
        @Var of connexions 
    */
    private $get_connexion;
    private const DB_DSN = "mysql:host=localhost;dbname=epaphrodite_bd";
    private const DB_USER = 'root';
    private const DB_PASS = 'root';
    private const option =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES  => false
    ]; 

    /* 
        Construct database connection 
    */
    function __construct()
    {
        $this->get_connexion = $this->epaphrodite_get_connexion();
    }

    /* 
        Get database connection 
    */
    public static function epaphrodite_get_connexion()
    {
        try {

            $get_connexion = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, self::option);

            return $get_connexion;

        } catch (PDOException $e) {

            echo "Probleme de connexion a la base de donnees: " . $e->getMessage();
        }
    }

    /* 
        Disconnexion 
    */
    public function closeConnection()
    {
        $this->get_connexion = NULL;
    }

    /* 
        SQL select request  
    */
    public function select($sql_chaine, $param, $datas = array())
    {
        $request = $this->get_connexion->prepare($sql_chaine);

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
    public function insert($sql_chaine, $param, $datas = array())
    {

        $request = $this->get_connexion->prepare($sql_chaine);

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
    public function delete($sql_chaine, $param, $datas = array())
    {
        $request = $this->get_connexion->prepare($sql_chaine);

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
    public function update($sql_chaine, $param, $datas = array())
    {
        $request = $this->get_connexion->prepare($sql_chaine);

        if (!empty($param)) {

            foreach ($datas as $k => &$v) {
                $request->bindParam($k + 1, $datas[$k], PDO::PARAM_STR);
            }
        }

        $result = $request->execute();

        return $result;
    }
}
