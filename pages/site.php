<?php

/**
 * Will display sites for user 
 */
require dirname(getcwd(), 1) . '/scripts/PartPreview.php';
?>

<head>
    <link rel="stylesheet" href="<?php echo ("http://$_SERVER[HTTP_HOST]" . "/19ia04_cerman/styles/adminbarStyle.css"); ?>">
    <link rel="stylesheet" href="<?php echo ("http://$_SERVER[HTTP_HOST]" . "/19ia04_cerman/styles/compilerStyles.css"); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>


<?php
$adminLogged = true;
if ($adminLogged) {
    include dirname(getcwd(), 1) . '/scripts/View/adminBar.php';
}

$PreviewHandler->RenderSite($_GET["siteName"]);
