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
     * Create globalInfo table
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
     * Create accountinfo table
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
     * Create parttable
     */
    function CreatePartsTable()
    {
        $sql = '
        CREATE TABLE parttable(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            PartNames VARCHAR(45) NOT NULL,
            PartCategory VARCHAR(45),
            PartData JSON,
            PartEnabled BIT(1) NOT NULL
        )
        ';
        $this->pdoConn->query($sql);
    }
    /**
     * Create partonsite table
     */
    function CreatePartOnSite()
    {
        $sql = '
        CREATE TABLE partonsite(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            SiteID INT(6),
            PartID INT(6),
            PartEnabled BIT(1) NOT NULL
        )
        ';
        $this->pdoConn->query($sql);
    }
    /**
     * Create sites table
     */
    function CreateSites()
    {
        $sql = '
        CREATE TABLE sites(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            SiteName VARCHAR(45),
            SiteCategory VARCHAR(45),
            SiteEnabled BIT(1) NOT NULL
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
    /**
     * Will return all data from table as json
     */
    function getDataFromTable($tableName)
    {
        $sql = $this->pdoConn->prepare("SELECT * FROM {$tableName}");
        $sql->execute();
        $data = $sql->fetchAll();
        return $data;
    }
    /**
     * Will update one value in column of specific table
     * 
     * @param string $tableName Table name changing data in
     * @param string $column Colum where you want to change value
     * @param mixed $value data to set to column
     * @param string $condition if you want to specify updating
     */
    function updateData($tableName, $column, $value, $condition)
    {
        if ($condition == null)
            $sql = $this->pdoConn->prepare("UPDATE {$tableName} SET {$column} = {$value};");
        if ($condition != null)
            $sql = $this->pdoConn->prepare("UPDATE {$tableName} SET {$column} = {$value} WHERE {$condition};");
        $sql->execute();
        $this->pdoConn->query($sql);
    }
    function deleteRowInTable($tableName, $parameter, $value)
    {
        $strVal = '"' . $value . '"';
        $sql = $this->pdoConn->prepare("DELETE FROM {$tableName} WHERE {$parameter}={$strVal}");
        $sql->execute();
        $this->pdoConn->query($sql);
    }
}
$DbAccess = new DbAccess();
