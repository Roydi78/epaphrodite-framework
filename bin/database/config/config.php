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

    function __construct()
    {
        $this->get_connexion = $this->epaphrodite_get_connexion();
    }
    
    /**
    * @var array
    */
    private const OPTION =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES  => false,
        PDO::ATTR_PERSISTENT => true
    ];  

    /**
    * @var string
    * @return string
    */      
    private function ini_config(){
        
        $ini = _DIR_CONFIG_ . "config.ini" ;
        $content = parse_ini_file ( $ini , true ) ;
        return $content;

    }    
    
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

    private function main(){



    }     

   /* 
        Get database connection 
    */
    public static function epaphrodite_get_connexion()
    {
        try {

            $get_connexion = new PDO( self::DB_DSN() , self::DB_USER(), self::DB_PASS(), self::OPTION);

            return $get_connexion;

        } catch (PDOException $e) {

            echo "Probleme de connexion a la base de donnees: " . $e->getMessage();

        }
    }    
   

}