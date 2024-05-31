<?php ob_start();
$topic = $reqtopics->fetch();   // récupérer le nom du topic

?>
<p>Bienvenue, <?= ($_SESSION["membre"]["pseudo"]) ?>!</p>   <!-- afficher le pseudo de la personne connectée -->

<h1><?= $topic["topics"] ?></h1> <!-- afficher le nom du topic -->

<p>Vous pouvez ajouter un message </p>
          
<form action="index.php?action=addMsg&id=<?= ($_GET['id'])?>" method="post">     <!-- récupérer l'id de topic-->
    <textarea name="posts" placeholder="message"> </textarea>                               <!-- afficher le message -->
    <input type="submit" name="submit" value="Ajouter">
</form>
<table>
    <thead>
        <tr>
            <th>posts</th>
            <th>date_Envoyé</th>
            <th>pseudo</th>
            
            
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listMsg->fetchAll() as $msg) {
            $date_Envoy = (new DateTime($msg['date_Envoy']))->format('d/m/Y H:i');   // changer le format de la datetime en francais 
            ?>
            <tr>
                <td><?= $msg['posts'] ?></td>
                <td><?= $date_Envoy ?></td>
                <td><?= $msg['pseudo'] ?></td>
                <?= $msg['topics'] ?></a>
            </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
require "template/template.php";