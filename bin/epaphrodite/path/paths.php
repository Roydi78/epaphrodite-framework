<?php

namespace bin\epaphrodite\path;

class paths extends host 
{

    /**
     * paths variables
     *
     * @var string $url_path_link
     * @var string $slug
    */
    private $url_path_link;

    /**
     * Host link path
     *
     * @return void
    */
    public function gethost()
    {

        return $this->host();

    }

    /**
     * Simple main link paths
     *
     * @param string $url_needed
     * @return void
    */ 
    public function main( string $url_needed )
    {

        $this->url_path_link = $this->gethost().'views/'.$this->slug($url_needed).'/';

        return $this->url_path_link;

    }  
    
    /**
     * Path main for @id
     *
     * @param string $url_needed
     * @param string $type_action
     * @param integer $id_needed
     * @return void
    */   
    public function main_id( string $url_needed , string $type_action , int $id_needed )
    {

        $this->url_path_link = $this->gethost().'admin-views/'.$url_needed.$type_action.$id_needed;

        return $this->url_path_link;

    }     

    /**
     * Simple dashboard path link
     *
     * @param string $url_needed
     * @return void
    */   
    public function dashboard( string $url_needed )
    {

        $this->url_path_link = $this->gethost().$this->slug($url_needed).'/';

        return $this->url_path_link;

    } 
    
    /**
     * Simple admin link path
     *
     * @param string $url_needed
     * @return void
    */   
    public function admin( string $url_needed )
    {

        $this->url_path_link = $this->gethost().'admin-views/'.$this->slug($url_needed).'/';

        return $this->url_path_link;

    }        

    /**
     * Path admin for @id
     *
     * @param string $url_needed
     * @param string $type_action
     * @param integer $id_needed
     * @return void
    */         
    public function admin_id( string $ordlinkneeded , string $type_action , int $id_needed )
    {

        $this->url_path_link = $this->gethost().'views/'.$ordlinkneeded.$type_action.$id_needed;

        return $this->url_path_link;

    }    

    /**
     * images paths
     *
     * @param string $img
     * @return void
    */
    public function img( string $img )
    {

        $this->url_path_link = $this->gethost().'static/img/'.$img;

        return $this->url_path_link;

    }     

    /**
     * js paths
     *
     * @param string $js
     * @return void
    */
    public function js( string $js )
    {

        $this->url_path_link = $this->gethost().'static/js/'.$js.'.js';

        return $this->url_path_link;

    }    
    
    /**
     * css paths
     *
     * @param string $css
     * @return void
    */      
    public function css( string $css )
    {

        $this->url_path_link = $this->gethost().'static/css/'.$css.'.css';

        return $this->url_path_link;

    } 

    /**
     * bootstrap font paths
     *
     * @param string $cssneeded
     * @return void
    */     
    public function font( string $cssneeded ){
        $this->url_path_link = $this->gethost().'static/font-awesome/css/'.$this->slug($cssneeded).'.css';
        return $this->url_path_link;
    } 

    /**
     * bootstrap font paths
     *
     * @param string $cssneeded
     * @return void
    */     
    public function icofont( string $cssneeded ){
        $this->url_path_link = $this->gethost().'static/icofont/'.$cssneeded.'.css';
        return $this->url_path_link;
    }     
    
    /**
     * pdf files paths
     *
     * @param string $pdfneeded
     * @return void
    */      
    public function pdf( string $pdfneeded )
    {

        $this->url_path_link = $this->gethost().'static/pdf'.$pdfneeded;

        return $this->url_path_link;

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

