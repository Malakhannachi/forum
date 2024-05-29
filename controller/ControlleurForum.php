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
        SELECT categorie.id_categorie, categorie.categorie
        FROM categorie");
        
        require ("view/listeCat.php");
    }

    public function listeTopics ($id) 
    {
        $pdo = Connect::seConnecter();
        // afficher liste topics avec le nom de categorie et le nom de membre 
        $listeTopics = $pdo->prepare("
            SELECT topics.date_Cr, topics.topics , categorie.categorie , membre.pseudo
            FROM topics
            INNER JOIN categorie ON topics.id_categorie = categorie.id_categorie   
            INNER JOIN membre ON topics.id_membre = membre.id_membre
            WHERE topics.id_categorie = :id
            ORDER BY date_Cr DESC");
        $listeTopics->execute(['id' => $id]);

        //$id_categorie = $pdo->query("
       // SELECT * 
        //FROM categorie ");
        //$id_membre = $pdo->query("
        //SELECT *
        //FROM membre ");
        
        require ("view/listeTopics.php");
       

        
    }
    
}
