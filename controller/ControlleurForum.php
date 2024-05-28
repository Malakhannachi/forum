<?php

namespace Controlleur;

use Model\Connect;

 class ControlleurForum {

    public function accueil() {
        $connect = new Connect();
        $pdo = $connect->seConnecter();
    }
}
