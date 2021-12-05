<?php
require(dirname(getcwd(), 1) . "\scripts\BackAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";
$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");

//Check if basic data on DB are created
if ($basicInfoCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicInfoCreate.php");
} else if ($basicAccountCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicAccountCreate.php");
}
//TODO: Check if site is done
$site_completed = false;

if ($site_completed == true) {
    //TODO: code to redirect to page

} else {
    //TODO: code to redirect to creating page

}
exit();
