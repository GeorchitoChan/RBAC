<?php
    namespace App\Core;

    class Controller
    {
        protected function view($view, $data = [])
        {
            require_once '../src/Views/' . $view . '.php';
        }
    }
?>