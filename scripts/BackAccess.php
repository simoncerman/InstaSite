<?php

class BackAccess
{
    private $Back_Dbaccess;
    public function __construct()
    {
        require(__DIR__ . '\DbAccess.php');
        $this->Back_Dbaccess = $DbAccess;
    }
    /**
     * Check if in table are any data
     * 
     * @param string $tableName Table name
     * @return bool TRUE if any data in table; FALSE if not data in table
     */
    function CheckDataInTable($tableName)
    {
        if ($this->Back_Dbaccess->TableExistCheck($tableName) == true) {
            if ($this->Back_Dbaccess->TableRecordsCount($tableName) > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    /**
     * Will check if is created Main(Creator) account
     * 
     * @param string $tableName Name of table searching in
     * @return bool TRUE if is creator account in table; FALSE if creator account is not in table
     */
    function CheckMainAccount($tableName)
    {
        if ($this->Back_Dbaccess->TableExistCheck($tableName) === true) {
            if ($this->Back_Dbaccess->AccountWithType("accountinfo", "Creator") > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->Back_Dbaccess->CreateAccountTable();
            return false;
        }
    }
}
$BackAccess = new BackAccess();