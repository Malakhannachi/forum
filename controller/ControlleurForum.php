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
            SELECT topics.id_topics, topics.date_Cr, topics.topics , categorie.categorie , membre.pseudo
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

    public function listMsg ($id) {
        $pdo = Connect::seConnecter();
        $listMsg = $pdo-> prepare("
        SELECT message.posts, message.date_Envoy, membre.pseudo, topics.topics
        FROM message
        INNER JOIN membre ON membre.id_membre = message.id_membre
        INNER JOIN topics ON topics.id_topics = message.id_topics
        WHERE message.id_topics = :id
        ORDER BY date_Cr DESC");
        $listMsg->execute(['id' => $id]);
        require ("view/listMsg.php");
    }
    public function addTopics () {
        $pdo = Connect::seConnecter();
        if (isset($_POST['submit'])) {
            $date_Cr = filter_input(INPUT_POST, "date_Cr", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topics = filter_input(INPUT_POST, "topics", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
            $id_categorie = filter_input(INPUT_POST, "id_categorie", FILTER_SANITIZE_NUMBER_INT);
            $id_membre = filter_input(INPUT_POST, "id_membre", FILTER_SANITIZE_NUMBER_INT);
            if ( $date_Cr && $topics && $id_categorie && $id_membre) {
                
        // afficher formulaire d'ajout de topic
        $addTopics = $pdo->prepare("
        INSERT INTO topics(date_Cr, topics, id_categorie, id_membre)
         VALUES (:date_Cr, :topics, :id_categorie, :id_membre)");
         $addTopics->execute([
            'date_Cr' => $date_Cr, 
            'topics' => $topics, 
            'id_categorie' => $id_categorie , 
            'id_membre' => $id_membre]);

        }

        }
        $id_categorie = $pdo->query("
       SELECT *
       FROM categorie ");
       $id_membre = $pdo->query("
       SELECT *
       FROM membre ");
        require ("view/addTopics.php");
    }
   
    
}
