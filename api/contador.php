<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

// Obtener el número de citas con estatus_cita=0
$sql = "SELECT COUNT(*) as num_citas FROM cita c
        WHERE c.estatus_cita = 0";

$query = $mysqli->query($sql);

$num_citas = array(
    'Todas las citas' => 0
);

if($query && $query->num_rows) {
  $resultado = $query->fetch_assoc();
  $num_citas['Todas las citas'] = $resultado['num_citas'];
}

echo json_encode($num_citas);
?>
