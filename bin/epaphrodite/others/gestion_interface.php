<?php

namespace bin\epaphrodite\others;


class gestion_interface
{

    private $auth_interface;
    private $type_user_connecter;

    /** ************************************************************************************
     *Admin interface manager
     * @param string $key|null
     * @return string
    */
    public function admin( ?int $key=null , ?string $url=null )
    {

        $this->auth_interface = 'views/login/';

        if( $key!==null ){ $this->auth_interface = 'admin_views/'; }

        return $this->auth_interface.$url;

    }

    /** 
     * Login interface manager
    */
    public function login()
    {

        $this->auth_interface = 'views/login/';

        return $this->auth_interface;
    }
}
