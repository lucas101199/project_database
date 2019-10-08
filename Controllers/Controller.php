<?php

abstract class Controller {

    abstract public function action_default();

    public function __construct(){

        //testing if a parameter action exist and
        //if it's correspond to a controller action
        if(isset($_GET['action']) and
            method_exists($this, "action_" . $_GET["action"]) ){
            $action = "action_" . $_GET["action"];
            $this->$action(); //calling this action
        }
        else
            $this->action_default(); //if else calling the default action
    }

    protected function render ($vue, $data = []) {

        extract($data);
        //Testing if the view exist
        $file_name = "Views/view_" . $vue . '.php';
        if(file_exists($file_name)){
            //if so, print it
            require ($file_name);
        }
        else{
            //if not, print the error view
            $this->action_error("La vue n'existe pas !");
        }
    }

    protected function action_error ($message) {
        $data = ['error' => $message];

        $this->render('error', $data);
        die();
    }
}