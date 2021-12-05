<?php
require(__DIR__ . '\DbAccess.php');
if($_POST["type"] == "NameTypeFirstInsert") {
       $webType = $_POST["webType"];
       $webName = $_POST["webName"];
       if ($DbAccess->TableExistCheck("globalinfo") == false) {
              $DbAccess->CreateDefaultTable();
       }
       if ($DbAccess->TableRecordsCount("globalinfo") == 0) {
              $DbAccess->InsertData("globalinfo", ["webName", "webType", "WebCompleted"], [$webName, $webType, 0]);
              echo ("Write into DB successfull");
       } else {
              echo ("Web is alredy created. If you want reinstall it go to settings on main site or reinstall!");
       }
}
if($_POST["type"] == "AccountInsert"){
       $tableName = "accountInfo";
       $AccountUsername = $_POST["AccountUsername"];
       $AccountPassword = $_POST["AccountPassword"];
       $AccountEmail    = $_POST["AccountEmail"];
       $AccountType     = $_POST["AccountType"];
       echo("Write into DB successful");
       if ($DbAccess->TableExistCheck($tableName) == false){
              $DbAccess -> CreateAccountTable();
       }
       //No account is created (first created account have main rules)
       if($DbAccess->TableRecordsCount($tableName) == 0){
              $AccountType = "Creator";
       }
       if($AccountEmail == "empty"){
              $DbAccess->InsertData(
                     $tableName,
                     ["AccountName","AccountType","AccountPassword"],
                     [$AccountUsername,$AccountType,$AccountPassword]);
       } else{
              $DbAccess->InsertData(
                     $tableName,
                     ["AccountName","AccountType","AccountPassword","AccountEmail"],
                     [$AccountUsername,$AccountType,$AccountPassword,$AccountEmail]);
       }
}