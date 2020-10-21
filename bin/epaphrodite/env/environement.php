<?php
namespace bin\epaphrodite\env;

class environement{

    public function truncate($string , $limit , $separator = '...' )
    {
        if(strlen($string) > $limit){
            $newlimit = $limit- strlen($separator);
            $finalchaine = substr($string , 0 , $newlimit + 1);
            return preg_replace("/&#039;/","'", (substr($finalchaine , 0 , strrpos($finalchaine , ' ' )))) . $separator;
        }
        return $string;
    }

    public function datedujour(){
        setlocale(LC_TIME,"fr_FR.UTF-8","French_France.1252");
        return strftime("%A %d %B %Y");
    }

}