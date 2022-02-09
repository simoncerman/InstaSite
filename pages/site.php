<?php

/**
 * Will display sites for user 
 */
require dirname(getcwd(), 1) . '/scripts/PartPreview.php';
?>

<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/global/head.php';
    ?>
</head>


<?php
$adminLogged = true;
if ($adminLogged) {
    include dirname(getcwd(), 1) . '/scripts/View/adminBar.php';
}

$PreviewHandler->RenderSite($_GET["siteName"]);
