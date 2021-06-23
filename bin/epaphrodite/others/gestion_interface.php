<?php

namespace bin\epaphrodite\others;


class gestion_interface
{

    private $auth_interface;
    private $type_user_connecter;


    public function gestion_interface_users()
    {

        $this->type_user_connecter = 'admin-views/admin-dashbaord/';

        return $this->type_user_connecter;
    }

    public function login_interface()
    {

        $this->auth_interface = 'views/login/';

        return $this->auth_interface;
    }
}
