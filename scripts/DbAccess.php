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
    /**
     * Create default table globalInfo
     */
    function CreateDefaultTable()
    {
        $sql = '
        CREATE TABLE globalinfo(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            WebName VARCHAR(50) NOT NULL,
            WebType VARCHAR(30),
            WebCompleted BIT(1) NOT NULL
        )';
        $this->pdoConn->query($sql);
    }
    /**
     * Create account table
     */
    function CreateAccountTable()
    {
        $sql = '
        CREATE TABLE accountinfo(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            AccountName VARCHAR(50) NOT NULL,
            AccountType VARCHAR(30) NOT NULL,
            AccountPassword VARCHAR(30) NOT NULL,
            AccountEmail VARCHAR(40)
        )';
        $this->pdoConn->query($sql);
    }
    /**
     * Create parts table
     * This table will contain parts with json data
     * data will be loading into page from json files
     */
    function CreatePartsTable()
    {
        $sql = '
        CREATE TABLE parttable(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            PartNames VARCHAR(50) NOT NULL,
            PartOnSite BIT(1) NOT NULL,
            PartSite VARCHAR(50),
            PartData JSON
        )
        ';
        $this->pdoConn->query($sql);
    }
    /**
     * Count how many account with class are in table
     * 
     * @param string $tableName name of table
     * @param string $AccountType type of account what we are counting
     * @return int Count of accounts with specific type
     */
    function AccountWithType($tableName, $AccountType)
    {
        $sql = "SELECT COUNT(*) FROM {$tableName} WHERE AccountType='{$AccountType}'";
        $stmp = $this->pdoConn->query($sql);
        $count = $stmp->fetchColumn();
        return $count;
    }
    /**
     * Check if a table exists in the current database.
     *
     * @param string $tableName Table to search for.
     * @return bool TRUE if table exists, FALSE if no table found.
     */
    function TableExistCheck($tableName)
    {
        // assuming you have already setup $pdo
        $sh = $this->pdoConn->prepare("DESCRIBE {$tableName}");
        if ($sh->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
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
     * Insert data into table
     * 
     *  @param string $tableName string of table inserting into
     *  @param array $parameterNameArray insert parameter names
     *  @param array $parameterValuesArray insert parameter values
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
                    if (is_numeric($parameterValuesArray[$y])) {
                        $sql = $sql . '' . $parameterValuesArray[$y] . '';
                    } else {
                        $sql = $sql . '"' . $parameterValuesArray[$y] . '"';
                    }
                } else {
                    if (is_numeric($parameterValuesArray[$y])) {
                        $sql = $sql . '' . $parameterValuesArray[$y] . '' . ",";
                    } else {
                        $sql = $sql . '"' . $parameterValuesArray[$y] . '"' . ",";
                    }
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
