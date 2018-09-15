<?php
include 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET["GetAppointments"])) 
{
    $stmt = $pdo->query('SELECT first_name FROM system_user');
    while ($row = $stmt->fetch())
    {
        echo $row['name'] . "\n";
    }
    exit();
}

echo json_encode("NOTHING SET");

?>