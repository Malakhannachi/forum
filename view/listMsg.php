<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th>posts</th>
            <th>date_Envoyé</th>
            <th>membre</th>
            <th>sujet</th>
            
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($listMsg->fetchAll() as $msg) {
            $date_Envoy = (new DateTime($msg['date_Envoy']))->format('d/m/Y');   // changer le format de la date en francais 
            ?>
            <tr>
                <td><?= $msg['posts'] ?></td>
                <td><?= $date_Envoy ?></td>
                <td><?= $msg['pseudo'] ?></td>
                <?= $msg['topics'] ?></a></td>
            </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
require "template/template.php";