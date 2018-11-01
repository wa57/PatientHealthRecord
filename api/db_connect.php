<?php
$servername = "localhost";
$username = "root";
$password = "UrTooSlow5!";

try 
{
    $db = new PDO("mysql:host=$servername;dbname=PatientHealthRecord", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch(PDOException $e) 
{
    echo "Connection failed: " . $e->getMessage();
}

class Database 
{
    private $servername;
    private $username;
    private $password;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "UrTooSlow5!";
    }

    public function getDatabase() 
    {
        try 
        {
            $db = new PDO("mysql:host={$this->servername};dbname=PatientHealthRecord", $this->username, $this->password);
            // set the PDO error mode to exception
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } 
        catch(PDOException $e) 
        {
            return "Connection failed: " . $e->getMessage();
        }
    }
}

?>