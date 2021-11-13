<?php
class DBCreater
{
    private $pdoConn;
    public function __construct()
    {
        $this->pdoConn = $this->CreateConn();
    }
    private function CreateConn()
    {
        /*
        $servername = "localhost";
        $username = "19ia04";
        $password = "2424383398651425";
        $dbname = "19ia04";
        */
        $pdo = new PDO('mysql:host=localhost;dbname=19ia04', '19ia04', '2424383398651425');
        return $pdo;
    }
    function CreateDefault()
    {
        $sql = '
        CREATE TABLE  globalInfo(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            SiteName VARCHAR(50) NOT NULL,
            SiteType VARCHAR(30)
            )';
        $this->pdoConn->query($sql);
    }
}
$DBCreater = new DBCreater();
