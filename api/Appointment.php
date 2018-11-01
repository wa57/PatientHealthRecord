<?php
require_once "db_connect.php";
class Appointment 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->db = $this->db->getDatabase();
    }

    public function getAppointmentsByPhysicianId($physician_id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `appointments` WHERE physician_id = :physician_id AND date > CURDATE()');
        $stmt->execute([':physician_id' => $physician_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($results);
    }

    public function cancelAppointment($appointment_id)
    {
        $stmt = $this->db->prepare('UPDATE appointments SET patient_id = NULL WHERE appointment_id = :appointment_id');
        $stmt->execute([':appointment_id' => $appointment_id]);
        echo json_encode("cancelled");
        exit();
    }
}

?>