<?php ob_start(); ?>

<p>Bienvenue, <?= ($_SESSION["membre"]["pseudo"]) ?>!</p>   <!-- afficher le pseudo de la personne connectée -->
<p>Vous pouvez ajouter un message</p>


<form action="index.php?action=addMsg" method="post">
    <input type="hidden" name="id_topics" value="<?= ($_GET['id_topics']) ?>">  <!-- récupérer l'id de topic-->
    <input type="textarea" name="message" placeholder="message">
    <input type="submit" name="submit" value="Ajouter">
</form>
<?php

$contenu = ob_get_clean();
require "template/template.php";