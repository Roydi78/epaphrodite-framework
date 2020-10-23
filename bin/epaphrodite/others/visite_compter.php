<?php

namespace bin\epaphrodite\others;

class visite_compter{

    public function ajouter_vue(){
        $fichiercompteur = _DIR_VISITOR_ . 'comptervisite';
        $fichier_comptage_jour = $fichiercompteur.'-'. date("Y-m-d");
        $this->incrementer_compteur($fichiercompteur);
        $this->incrementer_compteur($fichier_comptage_jour);
    }

    public function incrementer_compteur($fichiercompteur){
        
        $compteur = 1;
        if(file_exists($fichiercompteur)){
        $compteur = (int)file_get_contents($fichiercompteur);
        $compteur++;

        }
        
    file_put_contents($fichiercompteur, $compteur);

    }


    public function nombre_vues() {
        $fichiercompteur = _DIR_VISITOR_ . 'comptervisite';
        return file_get_contents($fichiercompteur);
    }


    public function nbre_vues_mois(){
        $fichiercompteur = _DIR_VISITOR_ . 'comptervisite'.'-'. date("Y") . '-' .date("m") .'-'. '*';
        $fichiercompteur = glob($fichiercompteur);
        $totalvisite = 0;
        foreach ($fichiercompteur as $fichiercompteur){
            $totalvisite += (int)file_get_contents($fichiercompteur);
        }
        return $totalvisite;
    }

    public function nbre_vues_total(){
        $fichiercompteurtotol = _DIR_VISITOR_ . 'comptervisite'.'-'. date("Y") . '-' .date("*") .'-'. '*';
        $fichiercompteurtotol = glob($fichiercompteurtotol);
        $totalvisitefichier = 0;
        foreach ($fichiercompteurtotol as $fichiercompteurtotol){
            $totalvisitefichier += (int)file_get_contents($fichiercompteurtotol);
        }
        return $totalvisitefichier;
    }

    public function nbre_vues_jour(){
        $fichiercompteur = _DIR_VISITOR_ . 'comptervisite'.'-'. date("Y") . '-' . date("m") .'-'. date("d");
        $fichiercompteur = glob($fichiercompteur);
        $totalvisitejour = 0;
        foreach ($fichiercompteur as $fichiercompteur){
            $totalvisitejour += (int)file_get_contents($fichiercompteur);
        }
        return $totalvisitejour;
    }
}