<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

$fecha_cita = $_GET["fecha_cita"];

// Consulta SQL para obtener las horas de cita en la fecha especificada
$sql = "SELECT hora_cita FROM cita WHERE fecha_cita = '$fecha_cita'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  // Si se encontraron citas para la fecha especificada, crear un arreglo con las horas de cita
  $horas_citas = array();
  while($row = $result->fetch_assoc()) {
    $hora_cita = $row["hora_cita"];
    array_push($horas_citas, $hora_cita);
  }
  // Devolver el arreglo de horas de cita en formato JSON
  echo json_encode($horas_citas);
} else {
  // Si no se encontraron citas para la fecha especificada, devolver un mensaje indicando esto
  echo "No se encontraron citas para la fecha especificada";
}

$mysqli->close();
?>
