<?php
session_start();
define("ROOT", str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
include(ROOT . 'app/Controller.php');
include(ROOT . 'app/Model.php');

$params = explode('/', $_GET['p']);

if ($params[0] != "") {
    $controller = ucfirst($params[0]);
    // Test si un deuxieme parametre existe sinon renvoie index
    $action = isset($params[1]) ? $params[1] : 'index';
    // Import le fichier php appelé avec l'url
    require_once (ROOT.'controllers/'.$controller.'.php');

    $controller = new $controller();
    //var_dump($controller);
    if (method_exists($controller, $action)){
        unset($params[0]);
        unset($params[1]);
        call_user_func_array([$controller, $action], $params);
    }else{
        http_response_code(404);
        echo "La page demandée n'existe pas";
    }
}else{
    include(ROOT . 'controllers/Sweat.php');
    $controller = new Sweat();
    $controller->index();
}