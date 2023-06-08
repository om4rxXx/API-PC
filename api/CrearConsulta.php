<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$tipo_consulta=$data["tipo_consulta"];
$proxima_cita_consulta = $data["proxima_cita_consulta"];
$peso_consulta = $data["peso_consulta"];
$producto_consulta = $data["producto_consulta"];
$aplico_consulta = $data["aplico_consulta"];
$descripcion_consulta = $data["descripcion_consulta"];
$observaciones_consulta = $data["observaciones_consulta"];
$id_mascota = $data["id_mascota"];
$id_veterinario = 1;
$id_cita = $data["id_cita"];

$sql = "INSERT INTO consulta (tipo_consulta, proxima_cita_consulta, peso_consulta, producto_consulta, aplico_consulta, descripcion_consulta, observaciones_consulta, id_mascota, id_veterinario, id_cita) 
        VALUES ('$tipo_consulta', '$proxima_cita_consulta', '$peso_consulta', '$producto_consulta', '$aplico_consulta', '$descripcion_consulta', '$observaciones_consulta', '$id_mascota', '$id_veterinario', '$id_cita')";

if ($mysqli->query($sql) === TRUE) {
  echo "Consulta creada exitosamente";
  // actualizar el estatus de la cita
  $sql = "UPDATE cita SET estatus_cita = 1 WHERE id_cita = '$id_cita'";
  if ($mysqli->query($sql) === TRUE) {
    echo "Estatus de la cita actualizado exitosamente";
  } else {
    echo "Error al actualizar el estatus de la cita: " . $mysqli->error;
  }
} else {
  echo "Error al crear la consulta: " . $mysqli->error;
}

$mysqli->close();
?>
