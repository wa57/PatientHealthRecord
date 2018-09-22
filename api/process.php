<?php
include 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET["GetAppointmentsByPhysicianId"])) 
{
    $stmt = $db->prepare('SELECT * FROM `appointments` WHERE physician_id = :physician_id AND date >= CURDATE()');
    $stmt->execute([':physician_id' => $_GET["physician_id"]]);
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_GET["GetAppointmentsByPatientId"]))
{
    $stmt = $db->prepare('SELECT * FROM `appointments` WHERE patient_id = :patient_id');
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_POST["CancelAppointment"]))
{
    $stmt = $db->prepare('UPDATE appointments SET patient_id = NULL WHERE appointment_id = :appointment_id');
    $stmt->execute([':appointment_id' => $_POST["appointment_id"]]);
    echo json_encode(true);
    exit();
}

if(isset($_GET["GetPhysicians"]))
{
    $stmt = $db->query('SELECT * FROM system_user WHERE role_id = 2');
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_POST["AuthenticateUser"]))
{
    $stmt = $db->prepare("SELECT * FROM system_user WHERE username = :username");
    $stmt->execute([':username' => $_POST["username"]]);
    $json = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($_POST['password'] == $json["password"])
    {
        echo json_encode($json);
    }
    else
    {
        echo json_encode(false);
    }
    exit();
}

if(isset($_POST["ScheduleAppointment"]))
{
    $stmt = $db->prepare("SELECT * FROM appointments WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_POST["patient_id"]]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if(count($results) > 1) //?????? 
    {
        echo json_encode("A user can only sign up for one appointment per day");
    } 
    else 
    { 
        $stmt = $db->prepare("UPDATE appointments SET patient_id = :patient_id WHERE appointment_id = :appointment_id;");
        $stmt->execute([':patient_id' => $_POST["patient_id"], ":appointment_id" => $_POST["appointment_id"]]);
        echo json_encode(true);
    }
    exit();
}

echo json_encode("NOTHING SET");

?>