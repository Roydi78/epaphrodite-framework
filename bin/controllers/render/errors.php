<?php

namespace bin\controllers\render;

use bin\controllers\render\twig;

class errors extends twig
{

    /**
     * Get class
     * @return void
     */
    function __construct()
    {
        $this->paths = new \bin\epaphrodite\path\paths();
        $this->msg = new \bin\epaphrodite\define\text_messages();
        $this->auth = new \bin\epaphrodite\auth\session_auth();
        $this->layouts = new \bin\epaphrodite\env\layouts;
    }

    /**
     * Page erreur 404
     *
     * @return exit
     */
    public function error_404()
    {
        $this->render(
            'errors/404',
            [
                'path' => $this->paths,
                'back' => $this->back(),
                'msg' => $this->msg,
                'layouts' => $this->layouts->errors(),
            ]
        );
        die();
    }

    /**
     * Page erreur 403
     *
     * @return exit
     */
    public function error_403()
    {
        $this->render(
            'errors/403',
            [
                'path' => $this->paths,
                'back' => $this->back(),
                'msg' => $this->msg,
                'layouts' => $this->layouts->errors(),
            ]
        );
        die();
    }

    /**
     * Page erreur 419 
     *
     * @return exit
     */
    public function error_419()
    {

        $this->render(
            'errors/419',
            [
                'path' => $this->paths,
                'msg' => $this->msg,
                'layouts' => $this->layouts->errors(),
            ]
        );

        $this->auth->deconnexion();
        die();
    }

    /**
     * Page erreur 500
     * 
     * @return exit
     */
    public function error_500()
    {

        $this->render(
            'errors',
            [
                'path' => $this->paths,
                'msg' => $this->msg,
                'layouts' => $this->layouts->errors(),
            ]
        );
        die();
    }

    /**
     * back manager
     * 
     * @return exit
     */
    private function back()
    {
        $path_init = $this->paths->gethost();
        $path_connect = $this->paths->dashboard();

        if ($this->auth->login() == NULL) {
            return $path_init;
        } else {
            return $path_connect;
        }
    }
}
