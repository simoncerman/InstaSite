<?php
require(__DIR__ . '\DbAccess.php');
if ($_POST["type"] == "NameTypeFirstInsert") {
       $webType = $_POST["webType"];
       $webName = $_POST["webName"];
       if ($DbAccess->TableExistCheck("globalinfo")==false){
              $DbAccess->CreateDefault();
       }
       if ($DbAccess->TableRecordsCount("globalinfo") == 0) {
              $DbAccess->InsertData("globalinfo", ["webName", "webType"], [$webName, $webType]);
       } else {
              echo ("Web is alredy created. If you want reinstall it go to settings on main site or reinstall!");
       }
}

