<?php

namespace bin\epaphrodite\define;

class text_messages
{
    public function answers($typeansers){
        $this->datas_type[] =
        [
            'site-title'=> 'AGENCE EPAPHRODITE',
            'author' => 'Agence epaphrodite',
            'description' => 'agence epaphrodite',
            'keywords' => "Agence epaphrodite  , Création; site web; digitale; community manager; logo; identité visuelle; marketing; communication; abidjan; Côte d'Ivoire; Afrique; Didier Drogba",
            'token_name' => 'token_crf_ep',
            'session_name' => 'ep_session',
            'language' => 'french',
            '403-title'=> 'ERREUR 403',
            '404-title'=> 'ERREUR 404',
            '419-title'=> 'ERREUR 419',
            '500-title'=> 'ERREUR 500',
            'login-wrong'=>'Login ou mot de passe incorrecte',
            'mdpnotsame'=>'mot de passe incorrecte',
            'mdpwrong'=>"L'ancien mot de passe est incorrecte",
            'send'=>'Félicitation votre message a été envoyé avec succès !!!',
            'done'=>'Félicitation votre inscription a été effectué avec succès !!!',
            'errorsending'=> "Désolé un problème est survenu lors de l'envoi de votre message !!!",
            'errordeleted'=> "Désolé un problème est survenu lors de la suppression !!!",
            'denie'=> "Traitement impossible !!!",
            'erreur' => "Désolé un problème est survenu lors de l'enregistrement !!!",
            'succes' => 'Traitement effectué avec succès !!!',
            'vide' => 'Veuillez remplir tous champs svp !!!',
            'noformat'=>'Le format du fichier incorrecte !',
            '403'=> 'Acces restreint !!!' ,
            '404'=> 'Oops! Aucune page trouvée !!!',
            '419'=> 'Votre session a expirée !!!',
            'connexion'=> 'Veuillez vous reconnecter à nouveau svp !',
            'back'=> "Retour page d'accueil",
        ];

        return $this->datas_type[0][$typeansers];
    }  

}