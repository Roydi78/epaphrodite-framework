<?php

namespace bin\database\config;

use PDO;
use PDOException;

class config
{

    
    /**
        * @var array
    */
    private $get_connexion;

    /**
    * @var array
    */
    private const OPTION =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES  => false
    ];  
    
    /**
    * @var string
    * @return string
    */    
    private static function DB_DSN(){

        return "mysql:host=localhost;dbname=epaphrodite_bd";
        
    }

    /**
    * @var string
    * @return string
    */       
    private static function DB_PASS(){

        return "root";
        
    }

    /**
    * @var string
    * @return string
    */       
    private static function DB_USER(){

        return "root";
        
    }

   /* 
        Get database connection 
    */
    public static function epaphrodite_get_connexion()
    {
        try {

            $get_connexion = new PDO(self::DB_DSN(), self::DB_USER(), self::DB_PASS(), self::OPTION);

            return $get_connexion;

        } catch (PDOException $e) {

            echo "Probleme de connexion a la base de donnees: " . $e->getMessage();

        }
    }    

    private function main(){



    }    

}