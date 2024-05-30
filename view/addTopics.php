<?php ob_start(); ?>
<h2>Ajouter un topic</h2>

<form action="index.php?action=addTopics" method="post">
    <input type="text" name="date_Cr" placeholder="date_Creation">
    <input type="text" name="topics" placeholder="topics">
    <select name="id_categorie" id="id_categorie">       <!--liste roulant des categorie--> 
            <option value="">Sélectionnez un categorie</option>
            <?php
                
                while ($cate = $id_categorie->fetch()) {
                    echo "<option value=" . $cate["id_categorie"] . ">" . $cate["categorie"] . "</option>"; //liste des categorie
                }
            ?>
        </select>

        <select name="id_membre" id="id_membre">       <!--liste roulant des membre--> 
            <option value="">Sélectionnez un membre</option>
            <?php
                
                while ($mem = $id_membre->fetch()) {
                    echo "<option value=" . $mem["id_membre"] . ">" . $mem["pseudo"] . "</option>"; //liste des membre
                }
            ?>
        </select>  
    <input type="submit" name="submit" value="Ajouter">
</form>
<?php

$contenu = ob_get_clean();
require "template/template.php";