<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

// Especificar el id_usuario a actualizar 0 pendiente 1 aceptado 2 rechazado
$id_usuario = $_GET["id_usuario"];
$numero= $_GET["numero"];

// Ejecutar consulta para actualizar el campo 'baja_usuario'
$sql = "UPDATE usuario SET estatus_usuario = '$numero' WHERE id_usuario = '$id_usuario'";
if($mysqli->query($sql)) {
  echo "El usuario ha sido dado de alta exitosamente.";
} else {
  echo "Hubo un error al actualizar el campo baja_usuario: " . $mysqli->error;
}




