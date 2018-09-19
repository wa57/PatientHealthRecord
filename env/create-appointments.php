<?php
include "../api/db_connect.php";

$stmt = $db->query('SELECT * FROM system_user WHERE role_id = 2');
$physicians = $stmt->fetchAll(PDO::FETCH_ASSOC);

$begin = new DateTime("9:00");
$end = new DateTime("17:00");

$today = date("Y-m-d");
foreach($physicians as $physician) 
{
    for($i = $begin; $i <= $end; $i->modify("+30 minutes"))
    {
        echo $i->format("H:i");
        $stmt = $db->prepare("INSERT INTO appointments VALUES (NULL, :physician_id, NULL, :today, :time)");
        $stmt->execute([':physician_id' => $physician["system_user_id"], ":today" => $today, ":time" => $i->format("H:i")]);
    }
}

?>