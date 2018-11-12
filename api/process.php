<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';
include 'util.php';
include 'SystemUser.php';
include 'Appointment.php';

header('Content-Type: application/json');
$util = new Util();

if(isset($_GET["GetAppointmentsByPhysicianId"])) 
{
    $Appointment = new Appointment();
    echo $Appointment->getAppointmentsByPhysicianId($_GET["physician_id"]);
    exit();
}

if(isset($_GET["GetAppointmentsByPatientId"]))
{
    $stmt = $db->prepare('SELECT * FROM `appointments` WHERE patient_id = :patient_id ORDER BY date DESC');
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($appointments as &$appointment) 
    {
        $stmt = $db->prepare('SELECT first_name, last_name FROM system_user WHERE system_user_id = :physician_id');
        $stmt->execute([':physician_id' => $appointment["physician_id"]]);
        $physician = $stmt->fetch(PDO::FETCH_ASSOC);
        $appointment["physician_name"] = $physician["first_name"]." ".$physician["last_name"];
    }

    echo json_encode($appointments);
    exit();
}

if(isset($_POST["CancelAppointment"]))
{
    $Appointment = new Appointment();
    echo $Appointment->cancelAppointment($_POST["appointment_id"]);
    exit();
}

if(isset($_GET["GetPhysicians"]))
{
    $SystemUser = new SystemUser();
    echo $SystemUser->getPhysicians();
    exit();
}

if(isset($_POST["AuthenticateUser"]))
{
    $SystemUser = new SystemUser();
    echo $SystemUser->authenticateUser($_POST["username"], $_POST["password"]);
    exit();
}

if(isset($_POST["RegisterUser"]))
{
    $SystemUser = new SystemUser();
    echo $SystemUser->registerUser($_POST["userInfo"]);
    exit();
}

if(isset($_POST["ScheduleAppointment"]))
{
    $stmt = $db->prepare("SELECT * FROM appointments WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_POST["patient_id"]]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $incompleteAppointmentFound = false; 
    foreach($results as $appointment) 
    {
        if($appointment["appointment_status"] == 0)
        {
            $incompleteAppointmentFound = true;
        }
    }
    
    if($incompleteAppointmentFound)
    {
        echo json_encode(false);
    } 
    else 
    { 
        $stmt = $db->prepare("UPDATE appointments SET patient_id = :patient_id WHERE appointment_id = :appointment_id;");
        $stmt->execute([':patient_id' => $_POST["patient_id"], ":appointment_id" => $_POST["appointment_id"]]);
        echo json_encode(true);
    }
    exit();
}

if(isset($_GET["GetLabTestsPerformedByUserId"]))
{
    $response = [];
    $stmt = $db->prepare("SELECT * FROM patient_lab_tests_performed WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result) 
    {
        $stmt = $db->prepare("SELECT * FROM lab_tests WHERE test_id = :test_id");
        $stmt->execute([':test_id' => $result["test_id"]]);
        $labTest = $stmt->fetch(PDO::FETCH_ASSOC);
        $response[] = array_merge($result, $labTest);
    }

    echo json_encode($response);
    exit();
}

if(isset($_GET["GetPatientPrescriptionsByPatientId"])) 
{
    $response = [];
    $stmt = $db->prepare("SELECT * FROM  patient_prescriptions WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result) 
    {
        $stmt = $db->prepare("SELECT * FROM prescriptions WHERE rx_id = :rx_id");
        $stmt->execute([':rx_id' => $result["rx_id"]]);
        $prescription = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $db->prepare("SELECT * FROM system_user WHERE system_user_id = :system_user_id");
        $stmt->execute([':system_user_id' => $result["physician_id"]]);
        $physician = $stmt->fetch(PDO::FETCH_ASSOC);

        $response[] = array_merge($result, $prescription, $physician);
    }

    echo json_encode($response);
    exit();
}

if(isset($_POST["SendPasswordResetEmail"])) {
    $stmt = $db->prepare("SELECT * FROM system_user WHERE username = :username");
    $stmt->execute([':username' => $_POST["username"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $state = false;
    if(!empty($user)) {
        $user["password"] = $util->randomPassword();

        $stmt = $db->prepare("UPDATE system_user SET password = :password WHERE system_user_id = :system_user_id;");
        $stmt->execute([':system_user_id' => $user["system_user_id"], ':password' => $user["password"]]);
        
        $to = $user["email"];
        $subject = "Password Reset";
        $message = $util->passwordResetEmailTemplate($user["password"]);
        $headers = 'From: noreply@patienthealthrecord.net' . "\r\n" .
                'Reply-To: noreply@patienthealthrecord.net' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($to, $subject, $message,  $headers);
        $state = true;
    }

    echo json_encode($state);
    exit();
}

echo json_encode("NOTHING SET");

?>