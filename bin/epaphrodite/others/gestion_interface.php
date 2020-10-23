<?php
namespace bin\epaphrodite\others;

class gestion_interface
{
    protected $type_user_connecter;
    protected $authentification_interface;

    public function gestion_interface_users()
    {

        $this->type_user_connecter = 'admin-views/admin-dashbaord/';

        return $this->type_user_connecter;
    }

    public function login_interface(){

        $this->authentification_interface = 'views/login/';

        return $this->authentification_interface;
    }

}