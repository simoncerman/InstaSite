<?php
class DbAccess
{
    private $pdoConn;
    public function __construct()
    {
        $this->pdoConn = $this->CreateConn();
    }
    private function CreateConn()
    {
        $servername = "localhost";
        $username = "19ia04";
        $password = "2424383398651425";
        $dbname = "19ia04";
        $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password);
        return $pdo;
    }
    function CreateDefault()
    {
        $sql = '
        CREATE TABLE  globalinfo(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            WebName VARCHAR(50) NOT NULL,
            WebType VARCHAR(30)
            )';
        $this->pdoConn->query($sql);
    }
    /**
     * Check if a table exists in the current database.
     *
     * @param string $table Table to search for.
     * @return bool TRUE if table exists, FALSE if no table found.
     */
    function tableExists($table)
    {
        try {
            $result = $this->pdoConn->query("SELECT 1 FROM {$table} LIMIT 1");
        } catch (Exception $e) {
            return FALSE;
        }
        return $result !== FALSE;
    }
    /**
     * Count how many records are in table
     * 
     * @param string $tableName Table name
     * @return int count of records in table
     */
    function TableRecordsCount($tableName)
    {
        $sql = "SELECT count(*) FROM " . $tableName;
        $stmp = $this->pdoConn->query($sql);
        $count = $stmp->fetchColumn();
        return $count;
    }
    /**
     *  @param $tableName -> String
     *  @param $parameterNameArray -> Array
     *  @param $parameterValuesArray -> Array
     */
    function InsertData($tableName, $parameterNameArray, $parameterValuesArray)
    {
        //count of parameters in both arrays must be same 
        if (count($parameterNameArray) == count($parameterValuesArray)) {
            $sql = 'INSERT INTO ' . $tableName . "(";
            for ($i = 0; $i < count($parameterNameArray); $i++) {
                if ($i == count($parameterNameArray) - 1) {
                    $sql = $sql . $parameterNameArray[$i];
                } else {
                    $sql = $sql . $parameterNameArray[$i] . ",";
                }
            }
            $sql = $sql . ") VALUES (";
            for ($y = 0; $y < count($parameterValuesArray); $y++) {
                if ($y == count($parameterValuesArray) - 1) {
                    $sql = $sql . '"' . $parameterValuesArray[$y] . '"';
                } else {
                    $sql = $sql . '"' . $parameterValuesArray[$y] . '"' . ",";
                }
            }
            $sql = $sql . ")";
            $this->pdoConn->query($sql);
        } else {
            echo ("Wrong parameters insertion");
        }
    }
}
$DbAccess = new DbAccess();
