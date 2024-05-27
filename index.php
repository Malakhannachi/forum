<?php
use Controller\SecuriteController;

spl_autoload_register(function ($class_name) {
    require $class_name.'.php';
});

$secuCtrl = new SecuriteController();

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case "register":$secuCtrl->register(); break;
        case "login":$secuCtrl->login(); break;
        case "logout":$secuCtrl->logout(); break;
       
        }
}