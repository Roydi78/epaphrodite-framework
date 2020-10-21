<?php

namespace bin\controllers\render;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class twig {

    private $loader;
    private $twig;
    
    /* 
      Twig path FilesystemLoader
    */    
    private function twig_filseystem(){
        
        $this->loader = new FilesystemLoader ( _DIR_VIEWS_ );

        return $this->loader;
    }

    /* 
      Twig path Environment
    */     
    public function twig_env(){

        $this->twig = new Environment ( $this->twig_filseystem() , [ 'cache' =>false ]);

        return $this->twig;
    }


}