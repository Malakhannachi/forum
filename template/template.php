<?php
// session_start(); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel = "stylesheet" href = "frontend/style.css" />
<title>Forum</title>

<body>
    <?php 
     // si je suis connecté 
    if ( isset ($_SESSION["membre"])) {     ?>          
        <a href="index.php?action=logout">Se déconnecter</a>
   <?php }   else { ?>
        <a href="index.php?action=login">Se connecter</a>
        <a href="index.php?action=register">S'incrire</a>
   <?php } ?>
   <div id="nav">
    <nav>
        <a href="index.php?action=accueil">Accueil</a>
        <a href="index.php?action=listeCat">Catégories</a>
       
    </nav>
   </div>
    
    <main>
     <div id="contenu">
           <?= $contenu ?>
    </div>
    
    </main>
    </div>
</body>
</html>