<?php
namespace bin\epaphrodite\env;

class env{

    /* 
        Tronquer le nombre de mot du text ou de la phrase
    */      
    public function truncate($string , $limit , $separator = '...' )
    {
        if(strlen($string) > $limit){
            $newlimit = $limit- strlen($separator);
            $finalchaine = substr($string , 0 , $newlimit + 1);
            return preg_replace("/&#039;/","'", (substr($finalchaine , 0 , strrpos($finalchaine , ' ' )))) . $separator;
        }

        return $this->chaine($string);

    }

    /* 
        Renvoyer la date sous forme de chaine de caractere  
    */   
    public function date_chaine($date){

        if($date==NULL){ $date = date('Y-m-d');}
        setlocale(LC_ALL, 'fr_FR').': ';
        return strftime( "%A %d %B %Y" , strtotime($date));
    }

    /* 
        Code ISO  
    */    
    public function chaine ( $chaine ){

        $pattern = [ "/&#039;/", "/&#224;/", "/&#225;/", "/&#226;/", "/&#227;/", "/&#228;/", "/&#230;/", "/&#231;/" , "/&#232;/" , "/&#233;/" , "/&#234;/" , "/&#235;/" , "/&#238;/", "/&#239;/", "/&#244;/", "/&#251;/", "/&amp;/"];
            
        $rep_pat = [ "'", "à", "á", "â", "ã", "ä", "æ", "ç", "è", "é", "ê", "ë", "î", "ï", "ô", "û", "&"];

        $str_noacc = preg_replace($pattern, $rep_pat, $chaine);

        return $str_noacc;
    
    }      

    public function import_fichier( $Lien_fichier ){

        $charger = $Lien_fichier .'/'.$_FILES['file']['name']; 

        move_uploaded_file($_FILES['file']['tmp_name'], $charger );

    }

}