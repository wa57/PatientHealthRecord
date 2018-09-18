<?php
include 'db_connect.php';

header('Content-Type: application/json');

if(isset($_GET["GetUnscheduledAppointments"])) 
{
    $stmt = $db->query('SELECT * FROM appointments WHERE patient_id IS NULL');
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_GET["GetUnscheduledAppointmentsByPhysicianId"])) 
{
    $stmt = $db->prepare('SELECT * FROM appointments WHERE patient_id IS NULL AND physician_id = :physician_id');
    $stmt->execute([':physician_id' => $_POST["physician_id"]]);
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
    $stmt = $db->prepare("UPDATE appointments SET patient_id = :patient_id WHERE appointment_id = :appointment_id;");
    $stmt->execute([':patient_id' => $_POST["patient_id"], ":appointment_id" => $_POST["appointment_id"]]);
    /*$json = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();*/
}

echo json_encode("NOTHING SET");

?>