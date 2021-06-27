<?php

namespace bin\epaphrodite\path;

class paths extends host 
{

    /**
     * paths variables
     *
     * @var string $path
     * @var string $slug
    */
    private $path;

    /**
     * Host path
     *
     * @return void
    */
    public function gethost()
    {

        return $this->host();

    }

    /**
     * Simple main paths
     *
     * @param ?string $url=null
     * @return void
    */ 
    public function main( ?string $url=null )
    {

        $this->path = $this->gethost().'views/'.$this->slug($url).'/';

        return $this->path;

    }  
    
    /**
     * Path main for @id
     *
     * @param string $url|null
     * @param string $action
     * @param integer $id
     * @return void
    */   
    public function main_id( ?string $url=null , string $action , int $id )
    {

        $this->path = $this->gethost().$url.$action.$id;

        return $this->path;

    }     

    /**
     * Dashboard path link
     *
     * @param string $url|null
     * @return void
    */   
    public function dashboard()
    {

        $this->path = $this->gethost().'dashbaord/admin/';

        return $this->path;

    } 
    
    /**
     * Admin link path
     *
     * @param string $url|null
     * @return void
    */   
    public function admin( ?string $url=null )
    {

        $this->path = $this->gethost().$this->slug($url).'/';

        return $this->path;

    }        

    /**
     * Admin for @id
     *
     * @param string $url|null
     * @param string $action
     * @param integer $id
     * @return void
    */         
    public function admin_id( string $url , string $action , int $id )
    {

        $this->path = $this->gethost().'views/'.$url.$action.$id;

        return $this->path;

    }    

    /**
     * images paths
     *
     * @param string $img
     * @return void
    */
    public function img( string $img )
    {

        $this->path = $this->gethost().'static/img/'.$img;

        return $this->path;

    }     

    /**
     * js paths
     *
     * @param string $js
     * @return void
    */
    public function js( string $js )
    {

        $this->path = $this->gethost().'static/js/'.$js.'.js';

        return $this->path;

    }    
    
    /**
     * css paths
     *
     * @param string $css
     * @return void
    */      
    public function css( string $css )
    {

        $this->path = $this->gethost().'static/css/'.$css.'.css';

        return $this->path;

    } 

    /**
     * bootstrap font paths
     *
     * @param string $cssneeded
     * @return void
    */     
    public function font( string $cssneeded ){
        $this->path = $this->gethost().'static/font-awesome/css/'.$this->slug($cssneeded).'.css';
        return $this->path;
    } 

    /**
     * bootstrap font paths
     *
     * @param string $cssneeded
     * @return void
    */     
    public function icofont( string $cssneeded ){
        $this->path = $this->gethost().'static/icofont/'.$cssneeded.'.css';
        return $this->path;
    }     
    
    /**
     * pdf files paths
     *
     * @param string $pdfneeded
     * @return void
    */      
    public function pdf( string $pdfneeded )
    {

        $this->path = $this->gethost().'static/pdf'.$pdfneeded;

        return $this->path;

    } 
    
    /**
     * slug constructor
     *
     * @param string $string
     * @param string $delimiter
     * @return void
    */
    private function slug( string $string , string $delimiter = '-' ) 
    {

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

    /**
     * slug constructor for href
     *
     * @param string $string
     * @param string $delimiter
     * @return void
    */      
    public function href_slug( string $string , string $delimiter = '_' ) 
    {

        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $this->slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $this->slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $this->slug);
        $this->slug = strtolower($this->slug);
        $this->slug = preg_replace("/[\%<>_|+ -]+/", $delimiter, $this->slug);
        $this->slug = trim($this->slug, $delimiter);
        setlocale(LC_ALL, $oldLocale);

        return $this->slug;

    }      

}

