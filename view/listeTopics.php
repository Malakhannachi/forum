<?php ob_start(); ?>


<table class="uk-table uk-table-striped">
    <thead> 
        <tr>
            <th>Date Creation</th>
            <th>Topics</th>
            
            <th>Pseudo</th>

        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listeTopics->fetchAll() as $topic) { 
            $dateCr = (new DateTime($topic['date_Cr']))->format('d/m/Y');  //changer le format de la date en francais
            ?>
            <tr>
                <td><?= $dateCr ?></td>
                <td><a href="index.php?action=listMsg&id=<?= $topic['id_topics'] ?>">
                <?= $topic['topics'] ?></a></td>
                <!--<td><?=$topic ['id_categorie'] ?></td>-->
                <!--<td><?= $topic['categorie'] ?></td>    afficher le nom de la catégorie -->
                <!--<td><?= $topic['id_membre'] ?></td>-->
                <td><?= $topic['pseudo'] ?></td>   <!-- afficher le pseudo du membre -->

            </tr>
            <?php } ?>
    </tbody>
</table>    

<?php   
$contenu = ob_get_clean();
require "template/template.php";