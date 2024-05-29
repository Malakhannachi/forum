<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>Categorie</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listeCat->fetchAll() as $cat) { ?>
            <tr>
                <td><a href="index.php?action=listeTopics&id=<?= $cat['id_categorie'] ?>">
                <?= $cat['categorie'] ?></a></td>
            </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
require "template/template.php";