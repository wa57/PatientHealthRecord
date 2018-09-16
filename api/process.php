<?php
include 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET["GetAppointments"])) 
{
    $stmt = $db->query('SELECT * FROM appointments WHERE patient_id IS NULL');
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_GET["GetPhysicians"]))
{
    $stmt = $db->query('SELECT * FROM system_user WHERE role_id = 2');
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_POST["Login"]))
{
    
}

echo json_encode("NOTHING SET");

?>