<?php ob_start(); ?>

<h1>Bienvenue</h1>
<?php

$contenu = ob_get_clean();
require "template/template.php";