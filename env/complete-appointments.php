<?php
include dirname(__DIR__)."/api/db_connect.php";
$stmt = $db->query('SELECT * FROM appointments WHERE date < NOW()');
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($appointments as $appointment) 
{
    $stmt = $db->prepare("UPDATE appointments SET appointment_status = 1 WHERE appointment_id = :appointment_id;");
    $stmt->execute([':appointment_id' => $appointment["appointment_id"]]);
}
?>