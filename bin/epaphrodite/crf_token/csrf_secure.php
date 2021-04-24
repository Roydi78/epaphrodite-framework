<?php

namespace bin\epaphrodite\crf_token;

use bin\database\connexion\processed_request;
use bin\epaphrodite\auth\session_auth;

class csrf_secure
{

    public $userbd;
    public $request;
    /**
     * Get class
     * @return void
     */    
    function __construct()
    {
        $this->request = new processed_request;
        $this->userbd = new session_auth();
        $this->messages = new \bin\epaphrodite\define\text_messages;
    }

    /**
     * Get class of select query builder
     *
     * @return \bin\database\querybilder\querybuilder
     */
    private function getclassQueryBuilder(): \bin\database\querybilder\querybuilder
    {
        return new \bin\database\querybilder\querybuilder();
    }     

    /**
     * Update token into database
     *
     * @param string $cookies
     * @return void
     */
    private function update_bd_token($cookies){

        $sql = $this->getclassQueryBuilder() 
        -> table('auth_secure') 
        -> set([ 'auth_key' ]) 
        -> where('auth') 
        -> UQuery();  

        $this->request->update_request($sql,'ss',[ $cookies , md5($this->userbd->login_user()) ] , false );
        
    }

    /**
     * Insert token into database
     *
     * @param string $cookies
     * @return void
     */     
    private function insert_bd_token($cookies){

        $sql = $this->getclassQueryBuilder() 
                    -> table('auth_secure') 
                    -> insert('auth , auth_key')
                    -> values( ' ? , ? ' )  
                    -> IQuery(); 

        $this->request->insert_request( $sql,'ss',[ md5($this->userbd->login_user()) , $cookies ], false );      

    }    

    /**
     * Get csrf value
     *
     * @return void
     */
    public function secure(){

        $sql = $this->getclassQueryBuilder() 
                    -> table('auth_secure')                   
                    -> where('auth') 
                    -> SQuery(NULL); 
       
        $result = $this->request->select_request( $sql, 's' , [ md5($this->userbd->login_user()) ] , false );
        
        if(!empty($result)){ return $result[0]['auth_key']; }else{ return 0;}       

    }

    /**
     * Get rooting csrf
     *
     * @param string $cookies
     * @return void
     */   
    public function get_csrf($cookies){

        if($this->secure()===0){

            $this->insert_bd_token($cookies);

            return false;

        }else{

            return $this->secure();

        }

    }



}
