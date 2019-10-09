<?php
session_start();

require_once("Utils/functions.php"); //get the function e()
require_once("Models/Model.php"); //Inclusion of the model
require_once("Controllers/Controller.php"); //Inclusion of the Controller classe

$controllers = ["login"]; //controllers list
$controller_default = "home"; //name of the default controller

//testing if the parameter controller exist and correspond to a controller on the list $controllers
if(isset($_GET['controller']) and in_array($_GET['controller'], $controllers))
    $name_controller = $_GET['controller'];
else
    $name_controller = $controller_default;

//set the name of the controller class
$name_class = 'Controller_' . $name_controller;

//set the name of the file containing the definition of the controller
$name_file = 'Controllers/' .  $name_class . '.php';

//if the file exist
if(file_exists($name_file)){

    //include and on instantiate an object of this class
    require_once($name_file);
    $controller = new $name_class();
}
else
    exit("Error 404: not found!");
