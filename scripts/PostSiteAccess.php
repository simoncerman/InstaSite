<?php
require(__DIR__ . '\DbAccess.php');
require(__DIR__ . '\JsonAccess.php');
require(__DIR__ . '\ComponentsHandler.php');
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
if ($_POST["type"] == "RemovePage") {
       //removing parts if it is only site where they are
       $siteName = $_POST["siteName"];
       $siteID = $DbAccess->getValueOfParam("sites", "SiteName", $siteName, "id");
       $data = $DbAccess->getDataFromTableWhere("partonsite", "SiteID", $siteID);
       for ($i = 0; $i < count($data); $i++) {
              $partID = $data[$i]["PartID"];
              //check if any other site is using this part
              if ($DbAccess->TableRecordsCountWhere("partonsite", "PartID", $partID) == 1) {
                     $DbAccess->deleteRowInTable("parttable", "id", $partID);
              }
       }
       print_r($data);
       //removing data from connecting table
       $DbAccess->deleteRowInTable("partonsite", "SiteID", $siteID);

       //removing site
       $tableName = "sites";
       $siteName =  $_POST["siteName"];
       $DbAccess->deleteRowInTable($tableName, "SiteName", $siteName);
}
if ($_POST["type"] == "RemovePartFromTable") {
       $siteName = $_POST["siteName"];
       $partName = $_POST["partName"];
       $partID = $DbAccess->getValueOfParam("parttable", "PartName", $partName, "id");
       $siteID = $DbAccess->getValueOfParam("sites", "SiteName", $siteName, "id");
       $DbAccess->deleteRowInTable("parttable", "id", $partID);
       $DbAccess->deleteRowSpecific("partonsite", "SiteID", $siteID, "PartID", $partID);
}
if ($_POST["type"] == "NewPartInsertion") {
       $partName = $_POST["partName"];
       $siteName = $_POST["siteName"];
       if (count($DbAccess->getDataFromTableWhere("parttable", "PartName", $partName)) == 0) {
              $DefaultPartData = ($JsonAccess->getDefaultPartData($partName));
              $DbAccess->InsertData("parttable", ["PartName", "PartCategory", "PartData", "PartEnabled"], [$partName, "basic", $DefaultPartData, 1]);
       }
       $partID = $DbAccess->getValueOfParam("parttable", "PartName", $partName, "id");
       $siteID = $DbAccess->getValueOfParam("sites", "SiteName", $siteName, "id");
       $DbAccess->InsertData("partonsite", ["SiteID", "PartID", "PartEnabled"], [$siteID, $partID, 1]);
}
if ($_POST["type"] == "UpdatingOnOffPart") {
       $partName     = $_POST["partName"];
       $condition    = "PartName=\"{$partName}\"";
       $setTo        = $_POST["setTo"];
       $DbAccess->updateData("parttable", "PartEnabled", $setTo, $condition);
}
if ($_POST["type"] == "ComponentHandling") {
       if ($_POST["subtype"] == "Remove") {

              $ComponentsHandler->RemoveComponent($_POST["path"]);
       }
       if ($_POST["subtype"] == "Edit") {
              $ComponentsHandler->UpdateComponent($_POST["path"], $_POST["data"]);
       }
       if ($_POST["subtype"] == "Add") {
              $ComponentsHandler->AddComponent($_POST["path"], $_POST["componentName"]);
       }
}
