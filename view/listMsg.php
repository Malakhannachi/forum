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
        foreach ($listMsg->fetchAll() as $msg) { ?>
            <tr>
                <td><?= $msg['posts'] ?></td>
                <td><?= $msg['date_Envoy'] ?></td>
                <td><?= $msg['pseudo'] ?></td>
                <?= $msg['topics'] ?></a></td>
            </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$contenu = ob_get_clean();
require "template/template.php";