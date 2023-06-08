<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$sql = "SELECT tipo_cita FROM cita WHERE estatus_cita = 0 ORDER BY id_cita DESC LIMIT 1";
$query = $mysqli->query($sql);

$tipo_cita = '';

if($query && $query->num_rows) {
  $resultado = $query->fetch_assoc();
  $tipo_cita = $resultado['tipo_cita'];
}

echo json_encode(array('tipo_cita' => $tipo_cita));
