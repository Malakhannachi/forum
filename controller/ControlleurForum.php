<?php

namespace Controlleur;

use Model\Connect;

 class ControlleurForum {

    public function accueil() {

        require ("view/acceuil.php");
    }

    public function listeCat () {
        $pdo = Connect::seConnecter();

        $listeCat = $pdo->query("SELECT * FROM categorie");
        $listeCat = $listeCat->fetchAll();
        require ("view/listeCat.php");
    }
}
