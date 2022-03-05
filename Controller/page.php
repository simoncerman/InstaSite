<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__ . "/Model/BackAccess.php");
require(__ROOT__ . "/Model/JsonAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";

$BackAccess->CheckTableCreated();

$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");

$site_completed = true;
$loadSite = true;

$administratorMode = false;

//Check if basic data on DB are created
if ($basicInfoCreated == false) {
    header("Location: " . $root . "/View/Sites/basicInfoCreate.php");
} else if ($basicAccountCreated == false) {
    header("Location: " . $root . "/View/Sites/basicAccountCreate.php?preselected=creator");
} else {
    header("Location: " . $root . "/View/Sites/site.php");
}

exit();
