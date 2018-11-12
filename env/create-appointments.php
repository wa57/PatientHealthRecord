<?php
include(dirname(__DIR__)."/api/db_connect.php");
date_default_timezone_set('America/New_York');
$stmt = $db->query('SELECT * FROM system_user WHERE role_id = 2');
$physicians = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($physicians as $physician) 
{
    $tomorrow = new DateTime("tomorrow");
    $endDate = new DateTime("tomorrow +1 week");

    for($j = $tomorrow; $j <= $endDate; $j->modify("+1 day")) {
        $begin = new DateTime("9:00");
        $end = new DateTime("17:00");
        for($i = $begin; $i <= $end; $i->modify("+30 minutes"))
        {
            $stmt = $db->prepare("INSERT INTO appointments VALUES (NULL, :physician_id, NULL, :date, :time, 0)");
            $stmt->execute([':physician_id' => $physician["system_user_id"], ":date" => $j->format("Y-m-d"), ":time" => $i->format("H:i")]);
        }
    }
}
?>