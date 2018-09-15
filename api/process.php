<?php
include 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET["GetAppointments"])) 
{
    $stmt = $db->query('SELECT * FROM system_user');
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

echo json_encode("NOTHING SET");

?>