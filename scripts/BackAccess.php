<?php

class BackAccess
{
    private $Back_Dbaccess;
    public function __construct()
    {
        require(__DIR__ . '\DbAccess.php');
        $this->Back_Dbaccess = $DbAccess;
    }
    function CheckDataInTable($tableName)
    {
        //TODO: Rework to TableRecordsCount -> TableExistCheck -- call Records Count later
        if ($this->Back_Dbaccess->TableRecordsCount($tableName) > 0) {
            return true;
        } else {
            return false;
        }
    }
    function CheckMainAccount($tableName)
    {
        //FIXME: Table exist check dont work
        if ($this->Back_Dbaccess->TableExistCheck($tableName) === true) {
            //TODO: Check if CREATOR Account exist 
        } else {
            //TODO: Create table of accounts
        }
    }
}
$BackAccess = new BackAccess();
