<?php
require(__DIR__ . '\DbAccess.php');
if ($_POST["type"] == "NameTypeFirstInsert") {
       $webType = $_POST["webType"];
       $webName = $_POST["webName"];
       if ($DbAccess->TableExistCheck("globalinfo") === FALSE) {
              $DbAccess->CreateDefaultTable();
       }
       if ($DbAccess->TableRecordsCount("globalinfo") == 0) {
              $DbAccess->InsertData("globalinfo", ["webName", "webType", "WebCompleted"], [$webName, $webType, 0]);
              echo ("Write into DB successfull");
       } else {
              echo ("Web is alredy created. If you want reinstall it go to settings on main site or reinstall!");
       }
}
if ($_POST["type"] == "AccountInsert") {
       $tableName = "accountInfo";
       $AccountUsername = $_POST["AccountUsername"];
       $AccountPassword = $_POST["AccountPassword"];
       $AccountEmail    = $_POST["AccountEmail"];
       $AccountType     = $_POST["AccountType"];
       echo ("Write into DB successful");
       if ($DbAccess->TableExistCheck($tableName) == false) {
              $DbAccess->CreateAccountTable();
       }
       //No account is created (first created account have main rules)
       if ($DbAccess->TableRecordsCount($tableName) == 0) {
              $AccountType = "Creator";
       }
       if ($AccountEmail == "empty") {
              $DbAccess->InsertData(
                     $tableName,
                     ["AccountName", "AccountType", "AccountPassword"],
                     [$AccountUsername, $AccountType, $AccountPassword]
              );
       } else {
              $DbAccess->InsertData(
                     $tableName,
                     ["AccountName", "AccountType", "AccountPassword", "AccountEmail"],
                     [$AccountUsername, $AccountType, $AccountPassword, $AccountEmail]
              );
       }
}
if ($_POST["type"] == "UpdatingOnOffSite") {
       $siteName   = $_POST["siteName"];
       $condition  = 'SiteName=';
       $condition .= '"';
       $condition .= $siteName;
       $condition .= '"';
       $setTo      = $_POST["setTo"];
       $DbAccess->updateData("sites", "SiteEnabled", $setTo, $condition);
}
if ($_POST["type"] == "NewSiteInsertion") {
       $pageName = $_POST["pageName"];
       $DbAccess->InsertData("sites", ["SiteName", "SiteCategory", "SiteEnabled"], [$pageName, "Basic", "1"]);
}
if ($_POST["type"] == "DeleteDataFromTable") {
       $tableName =  $_POST["tableName"];
       $value =      $_POST["value"];
       $param =      $_POST["param"];
       echo ($value);
       $DbAccess->deleteRowInTable($tableName, $param, $value);
}
if ($_POST["type"] == "NewPartInsertion") {
       $partName = $_POST["partName"];
       $siteName = $_POST["siteName"];
       $DbAccess->InsertData("parttable", ["PartName", "PartCategory", "PartData", "PartEnabled"], [$partName, "basic", " ", 1]);
       $partID = $DbAccess->getValueOfParam("parttable", "PartName", $partName, "id");
       $siteID = $DbAccess->getValueOfParam("sites", "SiteName", $siteName, "id");
       $DbAccess->InsertData("partonsite", ["SiteID", "PartID", "PartEnabled"], [$siteID, $partID, 1]);
}
