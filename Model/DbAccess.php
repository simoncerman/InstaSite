<?php
define('__ROOT__', dirname(dirname(__FILE__)));
class DbAccess
{
    private $pdoConn;
    public function __construct()
    {
        $this->pdoConn = $this->CreateConn();
    }
    private function CreateConn()
    {
        require_once __ROOT__ . "/adminSetup.php";
        $adminSetup = new AdminSetup();
        $this->servername = $adminSetup->servername;
        $this->username = $adminSetup->username;
        $this->password = $adminSetup->password;
        $this->dbname = $adminSetup->dbname;
        $pdo = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->dbname, $this->username, $this->password);
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
            PartName VARCHAR(45) NOT NULL,
            PartCategory VARCHAR(45),
            PartData TEXT,
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
            PartPosition INT(6),
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
        $sql = $this->pdoConn->prepare("SELECT COUNT(*) FROM {$tableName} WHERE AccountType='{$AccountType}'");
        $sql->execute();
        $count = $sql->fetchColumn();
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
        $sql = $this->pdoConn->prepare("SHOW TABLES LIKE '{$tableName}'");
        $sql->execute();
        $data = $sql->fetchAll();
        if (count($data) == 1) {
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
        $sql = $this->pdoConn->prepare("SELECT * FROM " . $tableName);
        $sql->execute();
        $count = $sql->fetchColumn();
        return $count;
    }
    /**
     * Count how many records in table with param
     * @param string $tableName Table name
     * @return int count of records in table
     */
    function TableRecordsCountWhere($tableName, $parameter, $value)
    {
        $sql = "SELECT count(*) FROM {$tableName} WHERE {$parameter}=\"{$value}\"";
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
                        $sql = $sql . "'" . $parameterValuesArray[$y] . "'";
                    }
                } else {
                    if (is_numeric($parameterValuesArray[$y])) {
                        $sql = $sql . '' . $parameterValuesArray[$y] . '' . ",";
                    } else {
                        $sql = $sql . "'" . $parameterValuesArray[$y] . "'" . ",";
                    }
                }
            }
            $sql = $sql . ")";
            echo ($sql);
            $this->pdoConn->exec($sql);
        } else {
            echo ("Wrong parameters insertion");
        }
    }
    /**
     * Will return all data from table
     * @param string $tableName is name of table working in
     * @return array data fetched
     */
    function getDataFromTable($tableName)
    {
        $sql = $this->pdoConn->prepare("SELECT * FROM {$tableName}");
        $sql->execute();
        $data = $sql->fetchAll();
        return $data;
    }
    /**
     * Will return specific data from table
     * @param string $tableName is name of table working in
     * @param string $parameter is checking parameter
     * @param string $value is parameter value 
     * @return array data fetched
     */
    function getDataFromTableWhere($tableName, $parameter, $value)
    {
        $sql = $this->pdoConn->prepare("SELECT * FROM {$tableName} WHERE {$parameter}=\"{$value}\"");
        $sql->execute();
        $data = $sql->fetchAll();
        return $data;
    }

    /**
     * Will return part data by site
     * @param string $siteName is name of site where you are seleting parts
     * @return sting
     */
    function GetPartData($siteName)
    {
        $sql = $this->pdoConn->prepare("SELECT * FROM partonsite
        INNER JOIN sites ON sites.id=partonsite.SiteID
        INNER JOIN parttable ON parttable.id=partonsite.PartID
        WHERE sites.SiteName = " . '"' . "{$siteName}" . '"' . " ORDER BY PartPosition ASC
        ");
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
        if ($condition == null) {
            $sql = $this->pdoConn->prepare("UPDATE {$tableName} SET {$column} = {$value};");
        }
        if ($condition != null) {
            $sql = $this->pdoConn->prepare("UPDATE {$tableName} SET {$column} = {$value} WHERE {$condition};");
            echo ("UPDATE {$tableName} SET {$column} = {$value} WHERE {$condition};");
        }
        $sql->execute();
    }
    /**
     * Will remove one row in table by specific input
     * 
     * @param string $tablename Name of table where you want to remove content
     * @param string $parameter is column where you are searching value and deleting that row
     * @param string $value is value which you are finding in column to delete row
     */
    function deleteRowInTable($tableName, $parameter, $value)
    {
        $strVal = '"' . $value . '"';
        $sql = $this->pdoConn->prepare("DELETE FROM {$tableName} WHERE {$parameter}={$strVal}");
        $sql->execute();
    }
    /**
     * Will remove one row in table by specific input, more specific then deleteRowInTable
     * @param string $tablename Name of table where you want to remove content
     * @param string $parameterFirst is column where you are searching value and deleting that row
     * @param string $valueFirts is value which you are finding in column to delete row
     * @param string $parameterSecound
     * @param string $valueSecound
     */
    function deleteRowSpecific($tableName, $parameterFirst, $valueFirts, $parameterSecound, $valueSecound)
    {
        $sql = $this->pdoConn->prepare("DELETE FROM {$tableName} WHERE {$parameterFirst}=\"{$valueFirts}\" AND {$parameterSecound}=\"{$valueSecound}\"");
        $sql->execute();
    }
    /**
     * Function which will return value of param
     * @param string $tableName Name of table working with
     * @param string $paramName Name of param using as key for select
     * @param string $paramValue Value of param as key
     * @param string $returnParam Which column you need to return¨
     * @return mixed Value returned
     */
    function getValueOfParam($tableName, $paramName, $paramValue, $returnParam)
    {
        $sql = $this->pdoConn->prepare("SELECT {$returnParam} FROM {$tableName} WHERE {$paramName}=" . '"' . "{$paramValue}" . '"' . ";");
        $sql->execute();
        $data = $sql->fetch();
        return $data[0];
    }
    /**
     * Function will return data from table by parameter, condition and tablename
     * @param string $tableName Name of table grabing from
     * @param string $parameter What you are grabing
     * @param string|null $condition string -> condition|null -> not condition
     */
    function GetValueWithCondition($tableName, $parameter, $condition)
    {
        if ($condition == null)
            $sql = $this->pdoConn->prepare("SELECT {$parameter} FROM {$tableName}");
        else
            $sql = $this->pdoConn->prepare("SELECT {$parameter} FROM {$tableName} WHERE {$condition}");
        $sql->execute();
        $data = $sql->fetch();
        return $data;
    }
    /**
     * Will find max value of parameter with condition
     */
    function GetMaxOfParam($tableName, $parameter, $condition)
    {
        $sql = $this->pdoConn->prepare("SELECT MAX({$parameter}) FROM {$tableName} WHERE {$condition}; ");
        $sql->execute();
        $data = $sql->fetch();
        return $data[0];
    }
}
$DbAccess = new DbAccess();
