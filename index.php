<?php

#Define utility functions.
require('sys/lib.php');

#Set everything up.
#require('app/config.php');

//Initialisation.
//...initialise autoloader.
#Load Base class
require('sys/base.class.php');
spl_autoload_register(function ($class) {
    include('sys/' . strtolower($class) . 'base.class.php');
    include('app/' . strtolower($class) . '.class.php');
});

#Handle requests.
/*Front-end controller. This 
1. Sets up an autoloader, 
2. Handles routing of messages.
3. Calls in classes and instantiates objects to despatch messages
*/

$config = new Config();

//Get route.
$router = new Router($config->locations(), $_SERVER['REQUEST_URI']);

list($action, $view, $table, $id) = $route = $router->get_route();

debug_message("action=$action, view=$view, table=$table, id=$id");//debug

//Dispatch it to controller.
$controller = new Controller($config->dbconnect(), $config->tables());

//$controller->despatch($route);
$controller->$action($view, $table, $id);
	
?>

