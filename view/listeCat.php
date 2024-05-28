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
                <td><?= $cat['categorie'] ?></td>
            </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
require "template/template.php";