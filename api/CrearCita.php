<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$descripcion_cita = $data["descripcion_cita"];
$tipo_cita = $data["tipo_cita"];
$observaciones_cita = isset($data["observaciones_cita"]) ? $data["observaciones_cita"] : null;
$fecha_cita = $data["fecha_cita"];
$hora_cita = $data["hora_cita"];
$id_mascota = $data["id_mascota"];
$id_usuario = $data["id_usuario"];
$id_veterinario = 1; // El ID del veterinario es fijo en este ejemplo
$estatus_cita = 0; // El estatus de la cita se establece en 0 por defecto

$sql = "INSERT INTO cita (descripcion_cita, tipo_cita, observaciones_cita, fecha_cita, hora_cita, id_mascota, id_usuario, id_veterinario, estatus_cita) 
        VALUES ('$descripcion_cita', '$tipo_cita', '$observaciones_cita', '$fecha_cita', '$hora_cita', '$id_mascota', '$id_usuario', '$id_veterinario', '$estatus_cita')";

if ($mysqli->query($sql) === TRUE) {
  echo "Cita creada exitosamente";
} else {
  echo "Error al crear la cita: " . $mysqli->error;
}

$mysqli->close();
?>
