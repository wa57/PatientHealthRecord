<?php
include 'db_connect.php';
include 'util.php';

header('Content-Type: application/json');

if(isset($_GET["GetAppointmentsByPhysicianId"])) 
{
    $stmt = $db->prepare('SELECT * FROM `appointments` WHERE physician_id = :physician_id AND date > CURDATE()');
    $stmt->execute([':physician_id' => $_GET["physician_id"]]);
    $json = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($json);
    exit();
}

if(isset($_GET["GetAppointmentsByPatientId"]))
{
    $stmt = $db->prepare('SELECT * FROM `appointments` WHERE patient_id = :patient_id');
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
    $stmt = $db->prepare('UPDATE appointments SET patient_id = NULL WHERE appointment_id = :appointment_id');
    $stmt->execute([':appointment_id' => $_POST["appointment_id"]]);
    echo json_encode("cancelled");
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

if(isset($_POST["RegisterUser"]))
{
    $user_info = json_decode($_POST['userInfo'], true);

    $form_exceptions = ["apartment", "zipcode-ext"];

    $response = array(
        "invalid" => false,
        "message" => "",
        "user" => $user_info
    );

    foreach($user_info as $key => $value) 
    {
        if(empty($value) && !in_array($key, $form_exceptions)) 
        {
            $response["invalid"] = true;
            $response["message"] = "All required fields must be filled in.";
        }
    }

    if($response["invalid"] == false)
    {
        $stmt = $db->prepare("SELECT * FROM system_user WHERE username = :username");
        $stmt->execute([':username' => $user_info["username"]]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($results)) 
        {
            $response["invalid"] = true;
            $response["message"] = "Someone with that username is already registered.";
        } 
        else 
        {
            $stmt = $db->prepare("INSERT INTO system_user VALUES (NULL, 1, :fname, :lname, :birthdate, :phone, :username, :password, :address, :apartment, :city, :state,:zipcode, :zipcode_ext, :email)");
            $stmt->execute([':fname' => $user_info["fname"], ':lname' => $user_info["lname"], ':birthdate' => $user_info["birthdate"], ':phone' => $user_info["phone"], ':username' => $user_info["username"], ':password' => $user_info["password"], ':address' => $user_info["address"], ':apartment' => $user_info["apartment"], ':city' => $user_info["city"], ':state' => $user_info["state"], ':zipcode' => $user_info["zipcode"], ':zipcode_ext' => $user_info["zipcode-ext"], ':email' => $user_info["email"]]);
            
            $stmt = $db->prepare("SELECT * FROM system_user WHERE username = :username");
            $stmt->execute([':username' => $user_info["username"]]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response["user"] = $results;
        }
    }

    echo json_encode($response);
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
    $stmt = $db->prepare("SELECT * FROM patient_lab_tests_performed WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
    exit();
}

if(isset($_GET["GetPatientPrescriptionsByPatientId"])) 
{
    $stmt = $db->prepare("SELECT * FROM  patient_prescriptions WHERE patient_id = :patient_id");
    $stmt->execute([':patient_id' => $_GET["patient_id"]]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
    exit();
}

echo json_encode("NOTHING SET");

?>