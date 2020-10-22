<?php
/*---------------------------------------------------------------*/
/*
    Titre : Vérifie la disponibilité de Nom De Domaine                                                                  
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=380
    Website auteur   : https://qwanturank-qwanturank-qwanturank.fr/                                                       
    Date édition     : 05 Mai 2008                                                                                        
    Date mise à jour : 19 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
    - maintenance du code                                                                                                 
    - amélioration du code                                                                                               
    - modification de la description                                                                                      
*/
/*---------------------------------------------------------------*/ 

    // .eu .fr .com .net .org .info .biz .de .ca .me.uk .co.uk .org.uk
    $theExt = array(".fr",".com",".eu",".ca",".info",".biz",".de",".org",".net")
;
    // .eu .fr .com .net .org .info .biz .de .ca .me.uk .co.uk .org.uk

    if (!($f=fopen("liste_ndd.txt","r")))
    exit("Impossible d'ouvrir le fichier."); 
    $f = 'liste_ndd.txt';
    $tab = array();
    if(file_exists($f)) {
        $tab = file($f);  // place le fichier dans un tableau
        $nb = count($tab);    // compte le nombre de ligne
        echo $nb;
        echo ' NDDs a vérifier';
    }


$i=0;
  while ($i<=$nb)
  {
        $theNdd = $tab[$i];
         $theNdd = escapeshellcmd($theNdd); 
        //on definit les case du tableau à vérifier
        $caseForVerif['.net']=7;
        $caseForVerif['.com']=7;
        $caseForVerif['.org']=0;
        $caseForVerif['.fr']=13;
        $caseForVerif['.ca']=5;
        $caseForVerif['.info']=0;
        $caseForVerif['.biz']=1;
        $caseForVerif['.de']=45;
        $caseForVerif['.eu']=50;
        $caseForVerif['.me.uk']=30;
        $caseForVerif['.co.uk']=30;
        $caseForVerif['.org.uk']=40;
        //on definit les phrase à vérifier dans ces cases
        $strForVerif['.com']='No match for "'.$theNdd.'.COM".';
        $strForVerif['.fr']='%% No entries found in the AFNIC Database.';
        $strForVerif['.net']='No match for "'.$theNdd.'.NET".';
        $strForVerif['.org']='NOT FOUND';
        $strForVerif['.ca']='';
        $strForVerif['.info']='NOT FOUND';
        $strForVerif['.biz']='';
        $strForVerif['.de']='';
        $strForVerif['.eu']='';
        $strForVerif['.me.uk']='';
        $strForVerif['.co.uk']='';
        $strForVerif['.org.uk']=''; 
        foreach($theExt as $anExt) {
            $myArray=""; 
            $anExt=escapeshellcmd($anExt);
            exec('whois '.$theNdd.$anExt,$myArray,$retval);
            if (!empty($theNdd))
            $result.=(strtolower($myArray[$caseForVerif[$anExt]])== 
                      strtolower($strForVerif[$anExt]))?"->> ".$theNdd.$anExt." 
                      est libre<br/>":"->> ".$theNdd.$anExt." 
                      est déjà réservé<br />";  

        } 
   $i++;
  }
   echo '<h3>'.str_replace('\\','',$result).'</h3>';
?>

                               

<?php
/*---------------------------------------------------------------*/
/*
    Titre : Vérifie librement la disponibilité d'un Nom De Domaine.                                                     
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=371
    Date édition     : 12 Avril 2008                                                                                      
    Date mise à jour : 26 Sept 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

$result = '';
$theNdd = trim($_POST['theNdd']);
$theExt = $_POST['theExt'];

if (!empty($theNdd) AND !empty($theExt)) {

       $theNdd = preg_replace(array( '/http://www./',
                                     '/http:///',
                                     '/www./' ),
                              array( '', '', '') ,$theNdd);

       $theNdd = preg_replace(array( '/.eu/',
                                     '/.fr/',
                                     '/.com/',
                                     '/.net/',
                                     '/.org/',
                                     '/.info/',
                                     '/.biz/',
                                     '/.de/',
                                     '/.me.uk/',
                                     '/.co.uk/',
                                     '/.org.uk/',
                                     '/.ca/' ),
               array( '', '', '', '', '', '', '', '', '', '', '', '') ,$theNdd);

        $theNdd = escapeshellcmd($theNdd);
        //on definit les case du tableau à vérifier
        $caseForVerif['.net']=7;
        $caseForVerif['.com']=7;
        $caseForVerif['.org']=0;
        $caseForVerif['.fr']=13;
        $caseForVerif['.ca']=5;
        $caseForVerif['.info']=0;
        $caseForVerif['.biz']=1;
        $caseForVerif['.de']=35;
        $caseForVerif['.eu']=50;
        $caseForVerif['.me.uk']=30;
        $caseForVerif['.co.uk']=30;
        $caseForVerif['.org.uk']=40;
        //on definit les phrase à vérifier dans ces cases
        $strForVerif['.com']='No match for "'.$theNdd.'.COM".';
        $strForVerif['.fr']='%% No entries found in the AFNIC Database.';
        $strForVerif['.net']='No match for "'.$theNdd.'.NET".';
        $strForVerif['.org']='NOT FOUND';
        $strForVerif['.ca']='';
        $strForVerif['.info']='NOT FOUND';
        $strForVerif['.biz']='';
        $strForVerif['.de']='';
        $strForVerif['.eu']='';
        $strForVerif['.me.uk']='';
        $strForVerif['.co.uk']='';
        $strForVerif['.org.uk']='';
        foreach($theExt as $anExt) {
            $myArray="";
            $anExt=escapeshellcmd($anExt);
            exec('whois '.$theNdd.$anExt,$myArray,$retval);
            $result.=(strtolower($myArray[$caseForVerif[$anExt]])==
                      strtolower($strForVerif[$anExt]))?"->> ".$theNdd.$anExt."
                      est libre<br/>":"->> ".$theNdd.$anExt."
                      est déjà réservé<br />";
        }
}
?>

<form action="" name="formVeirfNdd" enctype="multipart/form-data" method="post">
www.<input type="text" name="theNdd" value="<?php echo $theNdd; ?>" />
<input name="theExt[]" type="checkbox" value=".com" id="com" checked><label
 for="com">.com</label>
<input name="theExt[]" type="checkbox" value=".eu" id="eu"><label
 for="eu">.eu</label>
<input name="theExt[]" type="checkbox" value=".fr" id="fr"><label
 for="fr">.fr</label>
<input name="theExt[]" type="checkbox" value=".net" id="net"><label
 for="net">.net</label>
<input name="theExt[]" type="checkbox" value=".org" id="org"><label
 for="org">.org</label>
<input name="theExt[]" type="checkbox" value=".info" id="info"><label
 for="info">.info</label>
<input name="theExt[]" type="checkbox" value=".ca" id="ca"><label
 for="ca">.ca</label>
<input name="theExt[]" type="checkbox" value=".biz" id="biz"><label
 for="biz">.biz</label>
<input name="theExt[]" type="checkbox" value=".de" id="de"><label
 for="de">.de</label>
<input name="theExt[]" type="checkbox" value=".me.uk" id="me.uk"><label
 for="me.uk">me.uk</label>
<input name="theExt[]" type="checkbox" value=".co.uk" id="co.uk"><label
 for="co.uk">co.uk</label>
<input name="theExt[]" type="checkbox" value=".org.uk" id="org.uk"><label
 for="org.uk">org.uk</label>
<input type="submit" value="Vérifier">
</form>

<?php echo '<h3>'.$result.'</h3>';  ?>


                            
<?php
/*---------------------------------------------------------------*/
/*
    Titre : Redimensionner une image sans distorsion                                                                      
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=437
    Auteur           : philvert                                                                                           
    Date édition     : 23 Juil 2008                                                                                       
    Date mise à jour : 19 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

    function Resize_picture($fichier,$maxWidth,$maxHeight)
    {
    # Passage des paramètres dans la table : imageinfo
    $imageinfo= getimagesize("$fichier");
    $iw=$imageinfo[0];
    $ih=$imageinfo[1];
    # Paramètres : Largeur et Hauteur souhaiter $maxWidth, $maxHeight
    # Calcul des rapport de Largeur et de Hauteur
    $widthscale = $iw/$maxWidth;
    $heightscale = $ih/$maxHeight;
    $rapport = $ih/$widthscale;
    # Calul des rapports Largeur et Hauteur à afficher
    if($rapport < $maxHeight)
        {$nwidth = $maxWidth;}
     else
        {$nwidth = $iw/$heightscale;}
     if($rapport < $maxHeight)
        {$nheight = $rapport;}
     else
        {$nheight = $maxHeight;}

    # Affichage
    echo " <img src=$fichier width=\"$nwidth\" height=\"$nheight\">";
    }
?>