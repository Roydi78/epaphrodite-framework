<?php

namespace bin\epaphrodite\env;

class template
{

    /**
     * ******************************************************************************
     * Get template ( when user is connected )
     *
     * @param  $typeusers
     * @return string
     */
    public function template( $type_users ){


        if($type_users===1)
        {
            return "layouts/__default_admin.html.twig";
        }  

    }
    
    /**
     * ******************************************************************************
     * Get login template
     *
     * @return string
    */    
    public function login(){

        return "layouts/__default_login.html.twig";

    } 
    
    /**
     * ******************************************************************************
     * Get default template ( when user are not connected )
     *
     * @return string
    */    
    public function main(){

        return "layouts/__default_main.html.twig";

    }  
    
    /**
     * ******************************************************************************
     * Get default template ( when user are not connected )
     *
     * @return string
    */    
    public function admin(){

        return "layouts/__default_admin.html.twig";

    }
    
    /**
     * ******************************************************************************
     * Get default template ( when user are not connected )
     *
     * @return string
    */    
    public function forms(){

        return "layouts/__baseforms.html.twig";

    }  
    
    /**
     * ******************************************************************************
     * Get default template ( when user are not connected )
     *
     * @return string
    */    
    public function errors(){

        return "layouts/__default_errors.html.twig";

    }      

}