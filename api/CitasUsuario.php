<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_usuario = $_GET["id_usuario"];

// Obtener el número de citas por tipo de cita asociadas al usuario
$sql = "SELECT tipo_cita, COUNT(*) as num_citas FROM cita c
        JOIN mascotas m ON c.id_mascota = m.id_mascota
        WHERE m.id_usuario = $id_usuario
        GROUP BY tipo_cita";

$query = $mysqli->query($sql);

$num_citas = array(
    'Vacunacion' => 0,
    'Estetica' => 0,
    'Medica' => 0
);

if($query && $query->num_rows) {
  while($resultado = $query->fetch_assoc()) {
    $tipo_cita = $resultado['tipo_cita'];
    $num = $resultado['num_citas'];
    $num_citas[$tipo_cita] = $num;
  }
}

echo json_encode($num_citas);
