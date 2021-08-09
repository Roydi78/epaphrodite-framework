<?php

namespace bin\database\datas;

class datas
{

    /**
     * @param int $key
     * @return array
     */
    public function user(?int $key = null)
    {

        $list =
            [
                1 => 'USER',
                2 => 'ADMIN'

            ];

        if ($key === null) {
            return $list;
        } else {
            return $list[$key];
        }
    }

    /**
     * @param int $key
     * @return array
     */
    public function apps(?int $key = null)
    {

        $list =
            [
                1 => 'MON PROFIL',
                2 => 'GEST. DROITS ACCESS',
                3 => 'GEST. UTILISATEURS',
                4 => 'GEST. MESSAGERIE',

            ];

        if ($key === null) {
            return $list;
        } else {
            return $list[$key];
        }
    }
}
