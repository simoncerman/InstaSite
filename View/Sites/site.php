<?php

/**
 * Will display sites for user 
 */
require dirname(getcwd(), 2) . '/Model/PartPreview.php';
?>

<head>
    <link rel="stylesheet" href="<?php echo ("http://$_SERVER[HTTP_HOST]" . "/styles/adminbarStyle.css"); ?>">
    <link rel="stylesheet" href="<?php echo ("http://$_SERVER[HTTP_HOST]" . "/styles/compilerStyles.css"); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>


<?php
$adminLogged = true;
if ($adminLogged) {
    include dirname(getcwd(), 2) . '/View/SiteBlocks/adminBar.php';
}
//Move to home site if site is not selected
if (empty($_GET["siteName"])) {
    $homePage = $PreviewHandler->getHomepageName();
    if (!empty($homePage)) {
        header("Location: " . $root . "/View/Sites/site.php?siteName=" . $homePage);
    } else {
        header("Location: " . $root . "/View/Sites/pageEdit.php");
    }
}
$PreviewHandler->RenderSite($_GET["siteName"]);
