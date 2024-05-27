<?php ob_start(); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>s'inscrire</title>
</head>
<body>
    <h1>s'inscrire</h1>
    <form action="index.php?action=register" method="post">
        
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo"><br>

        <label for="email">Mail</label>
        <input type="email" name="email" id="email" placeholder="email"><br>

        <label for="pass1">Mot de passe</label>
        <input type="password" name="pass1" id="pass1"><br>

        <label for="pass2"> Confirmation de mot de passe</label>
        <input type="password" name="pass2" id="pass2"><br>

        <input type="submit" name="submit" value="s'inscrire">
    </form>
</body>
</html>
<?php
$title = "s'inscrire";
$contenu = ob_get_clean();
require "template/template.php";