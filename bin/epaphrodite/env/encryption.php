<?php

namespace bin\epaphrodite\env;

class encryption
{

    /**
     * Encrypt string value
     *
     * @param integer $method
     * @param string $value
     * @param int $keysize
     * @return void
     */
    public function method( int $method , string $value )
    {

        $keysize = 64;

        $salt = openssl_random_pseudo_bytes(16);

        $this->datas_type[] =
        [
            1 => hash_pbkdf2( 'sha256', $value , $salt ,100000, $keysize,true),
            2 => 'IMPORTATION DFA',
            3 => 'MIGRATIONS CANDIDAT',
            4 => "DEMANDE DE CHANGEMENT D'ECOLE",
            5 => 'DEMANDE DE CREATION ECOLE',
            6 => 'EFFECTIF ATTENDU',
            7 => 'CORRECTION DATE DE NAISSANCE',
            8 => 'DEMANDE MATRICULE CLOUD',
            9 => 'IMPORT MATRICULE CLOUD',
        ];

        return $this->datas_type[0][$method];        

    }

    

}