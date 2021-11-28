<?php
require(dirname(getcwd(), 1)."\scripts\BackAccess.php");
$root = "http://$_SERVER[HTTP_HOST]";


$basicInfoCreated = $BackAccess->CheckDataInTable("globalinfo");
$basicAccountCreated = $BackAccess->CheckMainAccount("accountinfo");

if ($basicInfoCreated == false) {
    header("Location: " . $root . "/19ia04_cerman/pages/basicInfoCreate.php");
}
else if ($basicAccountCreated == false){
    header("Location: " . $root . "/19ia04_cerman/pages/basicAccountCreate.php");
}
exit();