<?php
use Controller\SecuriteController;
use Controller\ControlleurForum;

spl_autoload_register(function ($class_name) {
    require $class_name.'.php';
});

$secuCtrl = new SecuriteController();
$ctrFrm = new ControlleurForum();
$id = isset($_GET['id']) ? $_GET["id"] : null;



if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 
            "register":$secuCtrl->register(); 
        break;
        case 
            "login":$secuCtrl->login(); 
        break;
         case 
         "logout":$secuCtrl->logout();
          break;
        case 
            "accueil":$ctrFrm->accueil(); 
        break;
        case 
            "listeCat":$ctrFrm->listeCat(); 
        break;
        case 
            "listeTopics":$ctrFrm->listeTopics( $id ); 
        break;
        case 
        "listMsg":$ctrFrm->listMsg( $id ); 
        break;
        case
        "addTopics":$ctrFrm->addTopics($id); 
        break;
        case
        "addMsg":$ctrFrm->addMsg($id); 
        break;
        case
        "delTopics":$ctrFrm->delTopics($id);
        break;
       



        }
   

    }

