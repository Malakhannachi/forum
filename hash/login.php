<?php ob_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
</head>
<body>
<h1>SE CONNECTER</h1>
   <form action="traitement.php?action=login" method="post">
       
    <label for="email">Email</label>
       <input type="email" name="email" id="email" placeholder="email"><br>

       <label for="password">Mot de passe</label>
       <input type="password" name="password" id="password" placeholder="password"><br>

       

       <input type="submit" name="submit" value="Se connecter">
   </form>
    
</body>
</html>
<?php
$contenu = ob_get_clean();
require "template/template.php";