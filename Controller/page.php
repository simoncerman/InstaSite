<?php
require(dirname(getcwd(), 1) . "\Model\BackAccess.php");
require(dirname(getcwd(), 1) . "\Model\JsonAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";

$BackAccess->CheckTableCreated();
$BackAccess->CheckPartsLoaded();

$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");

$site_completed = true;
$loadSite = true;

$administratorMode = false; //! FOR TESTING ONLY!!!

//Check if basic data on DB are created
if ($basicInfoCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/View/Sites/basicInfoCreate.php");
} else if ($basicAccountCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicAccountCreate.php");
} else if ($site_completed == false) {
    header("Location: " . $root . "/19ia04_cerman/View/Sites/pageEdit.php");
} else {
    header("Location: " . $root . "/19ia04_cerman/View/Sites/site.php");
}

exit();
