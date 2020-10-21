<?php

namespace bin\epaphrodite\path;

class paths extends host {

    private $linkurl;
    private $slug;

    /* 
        Host link path
    */
    public function gethost(){
        return $this->host();
    }

    /* 
        Ordinary link paths
    */
    public function main($ordlink){
        $this->linkurl = $this->gethost().'views/'.$this->slug($ordlink).'/';
        return $this->linkurl;
    }    

    /* 
        Administrator link paths ( dashboard )
    */    
    public function dashboard($adminlinkneeded){
        $this->linkurl = $this->gethost().$this->slug($adminlinkneeded).'/';
        return $this->linkurl;
    } 
    
    /* 
        Ordinary administrator link paths
    */    
    public function admin($adminlinkneeded){
        $this->linkurl = $this->gethost().'admin-views/'.$this->slug($adminlinkneeded).'/';
        return $this->linkurl;
    }     

    /* 
        articles link paths
    */     
    public function adidlink($adminlinkneeded , $typeaction , $idneeded){
        $this->linkurl = $this->gethost().'admin-views/'.$adminlinkneeded.$typeaction.$idneeded;
        return $this->linkurl;
    }    

    public function oridlink($ordlinkneeded , $typeaction , $idneeded){
        $this->linkurl = $this->gethost().'views/'.$ordlinkneeded.$typeaction.$idneeded;
        return $this->linkurl;
    }    

    /* 
         images paths 
    */     
    public function img($img_name,$extention){
        $this->linkurl = $this->gethost().'static/img/'.$this->slug($img_name).'.'.$extention;
        return $this->linkurl;
    }     

    /* 
         js paths 
    */      
    public function js($js){
        $this->linkurl = $this->gethost().'static/js/'.$js.'.js';
        return $this->linkurl;
    }    
    
    /* 
         css paths 
    */      
    public function css($css){
        $this->linkurl = $this->gethost().'static/css/'.$this->slug($css).'.css';
        return $this->linkurl;
    } 

    /* 
         bootstrap font paths 
    */      
    public function font($cssneeded){
        $this->linkurl = $this->gethost().'static/font-awesome/css/'.$this->slug($cssneeded).'.css';
        return $this->linkurl;
    } 
    
    /* 
         pdf files paths 
    */      
    public function pdf($pdfneeded){
        $this->linkurl = $this->gethost().'static/pdf'.$this->slug($pdfneeded);
        return $this->linkurl;
    } 
    
    /* 
        slug constructor
    */      
    private function slug( $string, $delimiter = '-' ) {

        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $this->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $this->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $this->slug);
        $this->slug = strtolower($this->slug);
        $this->slug = preg_replace("/[\/_|+ -]+/", $delimiter, $this->slug);
        $this->slug = trim($this->slug, $delimiter);
        setlocale(LC_ALL, $oldLocale);
        return $this->slug;

    }    

}

