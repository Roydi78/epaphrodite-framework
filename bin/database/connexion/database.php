<?php

namespace bin\database\connexion;
use PDO;
use PDOException;

class database
{
    /*
        @Var of connexions 
    */
        private $etablirconnexion;
        const DB_PASS = "root";
        const DB_DSN = "mysql:host=localhost;dbname=epaphrodite_bd";
        const DB_USER = 'root';
        const option =
            [
                PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES  => false
            ];

    /* 
        Construct database connection 
    */
        function __construct()
        {
            $this->etablirconnexion = $this->etalirlaconnexion();
        }

    /* 
        Get database connection 
    */
        public static function etalirlaconnexion()
        {
            try{
                
                $etablirconnexion = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS, self::option);
                
                return $etablirconnexion;

            }catch (PDOException $e){

                echo "Probleme de connexion a la base de donnees: " . $e->getMessage();

            }
        }

    /* 
        Disconnexion 
    */
        public function closeConnection()
        {
            $this->etablirconnexion = NULL;
        }

    /* 
        SQL select request  
    */
        public function select($sqlreq, $Typeparametre, $datasparam = array())
        {
            $request = $this->etablirconnexion->prepare($sqlreq);
            if (!empty($Typeparametre)) {
                foreach($datasparam as $k => &$v) 
                {
                    $request->bindParam($k + 1, $datasparam[$k], PDO::PARAM_STR);
                }
            }    
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }

    /* 
        SQL insert request  
    */
        public function insert($sqlreq, $Typeparametre, $datasparam = array())
        {
            $request = $this->etablirconnexion->prepare($sqlreq);
            if (!empty($Typeparametre)) {
                foreach($datasparam as $k => &$v) 
                {
                    $request->bindParam($k + 1, $datasparam[$k], PDO::PARAM_STR);
                }
            }    
            $result = $request->execute();
            return $result;
        }  
    
    /* 
        SQL delete request  
    */
        public function delete($sqlreq, $Typeparametre, $datasparam = array())
        {
            $requestdeleted = $this->etablirconnexion->prepare($sqlreq);
            
            if (!empty($Typeparametre)) {
                foreach($datasparam as $k => &$v) 
                {
                    $requestdeleted->bindParam($k + 1, $datasparam[$k], PDO::PARAM_STR);
                }
            }   
            $resultdeleted = $requestdeleted->execute();
            return $resultdeleted;
        }

    /* 
        SQL update request 
    */
        public function update($sqlreq, $Typeparametre, $datasparam = array())
        {
            $request = $this->etablirconnexion->prepare($sqlreq);
            
            if (!empty($Typeparametre)) {
                foreach($datasparam as $k => &$v) 
                {
                    $request->bindParam($k + 1, $datasparam[$k], PDO::PARAM_STR);
                }
            }    
            $result = $request->execute();
            return $result;
        }
        
}