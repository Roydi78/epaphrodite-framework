<?php

namespace bin\database\requests\json;
use \bin\database\connexion\processed_request;


class graph_datas
{

    private $request;

    /* 
      Get class 
    */
    function __construct()
    {
      $this->request = new processed_request;
      
    }

    /* 
      Get class of select query builder
    */    
    private function getclassQueryBuilder(): \bin\database\querybilder\querybuilder
    {
        return new \bin\database\querybilder\querybuilder();
    }  


    /* 
      Verify if exist in database
    */
    public function graph()
    {
      $sql = $this->getclassQueryBuilder() 
                    -> table('userdatabase')  
                    -> SQuery(NULL);
                    
      $result = $this->request->select_request($sql,NULL,NULL,true);

      echo $result;
    }     
    
    

}