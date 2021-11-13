<?php
class DBCreater{
    public function  (){

    }
}

function CreateConn()
{
    $servername = "localhost";
    $username = "19ia04";
    $password = "2424383398651425";
    $dbname = "19ia04";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }
}
function CreateDefault()
{
    /**
     * TODO: Rework into PDO!
     */
    $sql = '
    CREATE TABLE  globalInfo(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        SiteName VARCHAR(50) NOT NULL,
        SiteType VARCHAR(30)
        )'
    $conn = CreateConn()
    if (mysqli_query($conn, $sql)) {
        echo "Table MyGuests created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
function NewDefaultData()
{
    
}