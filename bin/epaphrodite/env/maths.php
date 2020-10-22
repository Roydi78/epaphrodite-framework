<?php
/*---------------------------------------------------------------*/
/*
    Titre : Affiche toute les racines carrés àpartir d'un entier                                                        
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=324
    Date édition     : 02 Jan 2008                                                                                        
    Date mise à jour : 06 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - refactoring du code en PHP 7                                                                                        
    - fonctionnement du code vérifié                                                                                    
    - amélioration du code                                                                                               
*/
/*---------------------------------------------------------------*/

// Initialise la variable de compteur
   $i = 0;
   // Initialiser cette valeur comme bon vous sembles
   $limite = 10000;
   do {
      // cherche la racine carré
      $racine_carre  = sqrt($i);

      // ce n'est pas un décimal, alors c'est un carré!!
      if ( preg_match ("#^[0-9]{1,12}$#", $racine_carre)) {
          echo 'La racine carré de '.$i.' est '.$racine_carre.'<br />';
      }
   $i++;
   // on continue tant que la limite n'est pas atteinte
   } while ($i < $limite);
?>

<?php
/*---------------------------------------------------------------*/
/*
    Titre : Affiche les nombres premiers compris entre 0 à$n                                                             
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=553
    Auteur           : mercier133                                                                                         
    Date édition     : 06 Jan 2010                                                                                        
    Date mise à jour : 13 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
    - maintenance du code                                                                                                 
*/
/*---------------------------------------------------------------*/

    function affichePremiers($n){
        echo "Les nombres premiers entre 0 et ".$n." sont : ";
        $negatif = false;
        if($n<0){
            $negatif = true;
            $n = -$n;
        }
        //On prend chaque nombre entre 2 et n (0 et 1 n'étant pas premier)
        for($i=2;$i<=$n;$i++){
            $nbDiv = 0;//Et on compte le nombre de diviseur    
            for($j=1;$j<=$i;$j++){
                if($i%$j==0){
                    $nbDiv++;            
                }
            }
            if($nbDiv == 2){
    //Un nombre premier est un chiffre qui ne possède que 2 diviseur (1 et
    // lui-même)
                if($negatif){
                    echo "-";
                }
                echo $i.", ";
            }
        }
    }
?>


                               

<?php
/*---------------------------------------------------------------*/
/*
    Titre : Trouve une distance euclidienne en PHP                                                                        
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=913
    Date édition     : 14 Fév 2019                                                                                        
    Date mise à jour : 18 Aout 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/

    function eucli_distance(array $a, array $b) {
        return
        array_sum(
            array_map(
                function($x, $y) {
                    return abs($x - $y) ** 2;
                }, $a, $b
            )
        ) ** (1/2);
    }
?>

<?php
    // S'assurer que les deux tableaux ont le même nombre d'éléments
    echo eucli_distance([1,2,5,6,4.6], [4,6,33,45,2.5]);
    // Affiche
    // 48.31573242744
?>


                            