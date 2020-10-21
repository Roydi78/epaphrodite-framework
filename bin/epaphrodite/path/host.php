<?php

namespace bin\epaphrodite\path;

class host {

    protected $host;
    protected $domain;

    /*
        Get domaine of website
    */    
    private function domain(){

        $this->domaine = "epaphrodite.com";
        return $this->domaine;
    }
        
    /* 
        Host link path
    */
    public function host(){

        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $this->host = $protocol . $_SERVER['HTTP_HOST'].'/'.$this->domain().'/';

        return $this->host;

    }

}