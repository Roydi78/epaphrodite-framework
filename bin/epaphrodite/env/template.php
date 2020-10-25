<?php

namespace bin\epaphrodite\env;

class template
{

    /**
     * Get template
     *
     * @param  $typeusers
     * @return string
     */
    public function template( $typeusers ){


        if($typeusers===1)
        {
            return "layouts/__default_administrateur_dsps.twig";
        }  

    }
    
    /**
     * Get login template
     *
     * @return string
    */    
    public function login(){

        return "layouts/__default_administrateur_dsps.twig";

    }     

}