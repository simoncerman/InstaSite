<?php
require(dirname(getcwd(), 1) . "\scripts\BackAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";
$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");
$site_completed = $BackAccess->CheckWebCompleted("");

//Check if basic data on DB are created
if ($basicInfoCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicInfoCreate.php");
} else if ($basicAccountCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicAccountCreate.php");
} else if ($site_completed == false) {
    //TODO: code to redirect to creating page
    echo ("Enjoy creating");
} else {
    //TODO: code to redirect to page
    echo ("enjoi paging");
}
exit();
