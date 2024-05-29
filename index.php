<?php
use Controller\SecuriteController;
use Controller\ControlleurForum;

spl_autoload_register(function ($class_name) {
    require $class_name.'.php';
});

$secuCtrl = new SecuriteController();
$ctrFrm = new ControlleurForum();
$id = isset($_GET['id_categorie']) ? $_GET["id_categorie"] : null;



if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 
            "register":$secuCtrl->register(); 
        break;
        case 
            "login":$secuCtrl->login(); 
        break;
        // case "logout":$secuCtrl->logout(); break;
        case 
            "accueil":$ctrFrm->accueil(); 
        break;
        case 
            "listeCat":$ctrFrm->listeCat(); 
        break;
        case 
            "listeTopics":$ctrFrm->listeTopics( $id ); 
        break;
        }
        

    }

