<?php

abstract class Controller {

    abstract public function action_default();

    public function __construct(){

        //On teste si un paramètre action existe et
        //s'il correspond à une action du contrôleur
        if(isset($_GET['action']) and
            method_exists($this, "action_" . $_GET["action"]) ){
            $action = "action_" . $_GET["action"];
            $this->$action(); //On appelle cette action
        }
        else
            $this->action_default(); //On appelle sinon l'action par défaut
    }

    protected function render ($vue, $data = []) {

        extract($data);
        //On teste si la vue existe
        $file_name = "Views/view_" . $vue . '.php';
        if(file_exists($file_name)){
            //Si oui, on l'affiche
            require ($file_name);
        }
        else{
            //Sinon, on affiche la page d'erreur
            $this->action_error("La vue n'existe pas !");
        }
    }

    protected function action_error ($message) {
        $data = ['erreur' => $message];

        $this->render('error', $data);
        die();
    }
}