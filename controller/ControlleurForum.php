<?php

namespace Controller;

use Model\Connect;

 class ControlleurForum {

    public function accueil()  
    {

        require ("view/acceuil.php");
    }

    public function listeCat () 
    {
        $pdo = Connect::seConnecter();
        $listeCat = $pdo->query("
        SELECT id_categorie, categorie 
        FROM categorie");
        require ("view/listeCat.php");
    }

    public function listeTopics ($id) 
    {
        $pdo = Connect::seConnecter();
        $listeTopics = $pdo->prepare("
        SELECT *
        FROM topics
        WHERE id_categorie = :id
        ORDER BY date_creation DESC");
        $listeTopics->execute(['id' => $id]);
       

        require ("view/listeTopics.php");
    }
}
