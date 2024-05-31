<?php ob_start(); ?>

<p>Bienvenue, <?= ($_SESSION["membre"]["pseudo"]) ?>!</p>   <!-- afficher le pseudo de la personne connectée -->
<p>Vous pouvez ajouter un topic</p>


<form action="index.php?action=addTopics&id=<?= ($_GET['id']) ?>" method="post">
    <input type="text" name="topics" placeholder="topics">
    <input type="hidden" name="id_categorie" value="<?= ($_GET['id']) ?>"> <!-- récupérer l'id de la catégorie -->

    <input type="submit" name="submit" value="Ajouter">
</form>
<?php

$contenu = ob_get_clean();
require "template/template.php";