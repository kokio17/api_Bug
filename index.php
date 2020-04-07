<?php
require 'vendor/autoload.php';
use BugApp\Controllers\BugController;

$controller = new BugController();

$arguments = explode("/", $_SERVER["REQUEST_URI"]);

switch ($arguments[3]) {
    case "":
        header("Location: list");
        break;
    case "list":
        return $controller->list();
        break;
    case "show":
        $id = $arguments[4]; 
        return $controller->show($id);
        break;
    case "add":
        return $controller->add();
        break;
    case "update":
        $id = $arguments[4];
        $controller->updateBug($id);
        break;
    case "edit":
        $id = $arguments[4];
        $controller->edit($id);
        break;
    default:
        require '404.php';
}