<?php
//include(dirname(__DIR__)."/api/db_connect.php");
date_default_timezone_set('America/New_York');
$stmt = $db->query('SELECT * FROM system_user WHERE role_id = 2');
$physicians = $stmt->fetchAll(PDO::FETCH_ASSOC);

$tomorrow = new DateTime("tomorrow");
//$begin_date = new DateTime("tomorrow");
//$end_date = $begin_date->modify("+30 days");

/*for($i = $begin_date; $i <= $end_date; $i->modify("+1 day")) 
{
    print_r($i);
}*/

foreach($physicians as $physician) 
{
    $begin = new DateTime("9:00");
    $end = new DateTime("17:00");
    for($i = $begin; $i <= $end; $i->modify("+30 minutes"))
    {
        $stmt = $db->prepare("INSERT INTO appointments VALUES (NULL, :physician_id, NULL, :tomorrow, :time, 0)");
        $stmt->execute([':physician_id' => $physician["system_user_id"], ":tomorrow" => $tomorrow->format("Y-m-d"), ":time" => $i->format("H:i")]);
    }
    //$tomorrow->modify("1")
}
?>