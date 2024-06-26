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
        // requête pour récupérer le nom de la catégorie
        $reqCategorie = $pdo->prepare("
        SELECT *
        FROM categorie
        WHERE id_categorie = :id");
        $reqCategorie->execute(['id' => $id]);

        // afficher liste topics avec le nom de categorie et le nom de membre
        $listeTopics = $pdo->prepare("
            SELECT topics.id_topics, topics.date_Cr, topics.topics , categorie.categorie , membre.pseudo
            FROM topics
            INNER JOIN categorie ON topics.id_categorie = categorie.id_categorie   
            INNER JOIN membre ON topics.id_membre = membre.id_membre
            WHERE topics.id_categorie = :id
            ORDER BY date_Cr DESC");
        $listeTopics->execute(['id' => $id]);
        
        require ("view/listeTopics.php");
        
    }

    public function listMsg ($id) {
        $pdo = Connect::seConnecter();
        // requete pour récuperer le nom de topic 
        $reqtopics = $pdo->prepare("
        SELECT *
        FROM topics
        WHERE id_topics = :id");
        $reqtopics->execute(['id' => $id]);
        
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
    public function addTopics ($id) {
       
        $pdo = Connect::seConnecter();
        if (isset($_POST['submit'])) {
            //$date_Cr = filter_input(INPUT_POST, "date_Cr", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $topics = filter_input(INPUT_POST, "topics", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
            $id_membre = $_SESSION["membre"]["id_membre"];   // récupérer l'id du membre
            if ( $topics && $id_membre) {
                
                // afficher formulaire d'ajout de topic
                $addTopics = $pdo->prepare("
                INSERT INTO topics( topics, id_categorie, id_membre)
                VALUES (:topics, :id_categorie, :id_membre)");
                $addTopics->execute([
                    'topics' => $topics, 
                    'id_categorie' => $id , 
                    'id_membre' => $id_membre 
                ]);
                
                header("Location: index.php?action=listeTopics&id=".$id);  // rediriger vers la page listeTopics
                        exit;
            }

        }
    }
    public function addMsg ($id) {

        $pdo = Connect::seConnecter();
        if (isset($_POST['submit'])) {
            $posts = filter_input(INPUT_POST, "posts", FILTER_SANITIZE_FULL_SPECIAL_CHARS);   
            $id_membre = $_SESSION["membre"]["id_membre"];   // récupérer l'id du membre
            if ( $posts && $id_membre ) {
                
            // afficher formulaire d'ajout de topic
                $addMsg = $pdo->prepare("
                INSERT INTO message( posts, id_topics, id_membre)
                VALUES (:posts, :id_topics, :id_membre)");
                $addMsg->execute([
                    'posts' => $posts, 
                    'id_topics' => $id,   // récupérer l'id du topic
                    'id_membre' => $id_membre ]);

                    header("Location: index.php?action=listMsg&id=".$id); // rediriger vers la page listMsg
                    exit;

                }       

        }
        
        
        
    }

    public function delTopics ($id)  // supprimer un topic par son id
    {
        $pdo = Connect::seConnecter();
        $delTopics = $pdo->prepare("
        DELETE FROM topics
        WHERE id_topics = :id");
        $delTopics->execute(['id' => $id]);
        header("Location: index.php?action=accueil");
        exit;
    }
   
    
}
