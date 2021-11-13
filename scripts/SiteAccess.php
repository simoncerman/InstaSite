<?php
require(__DIR__ . '\DbCreate.php');
if ($_POST["type"] == "NameTypeFirstInsert") {
       $webType = $_POST["webType"];
       $webName = $_POST["webName"];
       $DBCreater->CreateDefault();
}
