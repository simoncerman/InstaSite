<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include dirname(getcwd(), 1) . '/pageParts/head.php';
    ?>
</head>

<body>
    <?php
    require dirname(getcwd(), 1) . '/scripts/BackAccess.php';
    $site = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    echo ($BackAccess->LoadPartData($site));
    ?>
</body>