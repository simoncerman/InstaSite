<?php
require(dirname(getcwd(), 1) . "\scripts\BackAccess.php");
require(dirname(getcwd(), 1) . "\scripts\JsonAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";

$json = file_get_contents(dirname(getcwd(), 1) . "\pageParts\header_default.json");
$parsed = json_decode($json,true);
echo($parsed["partData"]["objects"]["header"]["content"]["image"]["scr"]);
//$JsonAccess->HTML_Encode($json);

/*$BackAccess->CheckTableCreated(); 

$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");
$site_completed = $BackAccess->CheckWebCompleted("");

//Check if basic data on DB are created
if ($basicInfoCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicInfoCreate.php");
} else if ($basicAccountCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicAccountCreate.php");
} else if ($site_completed == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/partMenuSelector.php");
    echo ("Enjoy creating");
} else {
    //TODO: code to redirect to page
    echo ("enjoi paging");
}
*/
exit();