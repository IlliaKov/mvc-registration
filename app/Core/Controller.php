<?php
class Controller
{
    public function model($model)
    {
        require_once '../app/Models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = [])
    {
//        require_once '../app/server.php';
//        require_once '../app/style.css';
//        require_once '../app/errors.php';
//        include('../app/server.php');

        require_once '../app/Views/' . $view . '.php';
    }
}