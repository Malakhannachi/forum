<?php ob_start(); ?>


<table class="uk-table uk-table-striped">
    <thead> 
        <tr>
            <th>Date Creation</th>
            <th>Topics</th>
            <th>Categorie</th>
            <th>Mmembre</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listeTopics->fetchAll() as $topic) { ?>
            <tr>
                <td><?= $topic['date_Cr'] ?></td>
                <td><?= $topic['topics'] ?></td>
                <td><?=$topic ['id_categorie'] ?></td>
                <td><?= $topic['id_membre'] ?></td>
            </tr>
            <?php } ?>
    </tbody>
</table>    

<?php   
$contenu = ob_get_clean();
require "template/template.php";