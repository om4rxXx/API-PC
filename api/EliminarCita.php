<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_cita = $_GET["id_cita"];

$sql = "DELETE FROM cita WHERE id_cita = $id_cita";

if ($mysqli->query($sql) === TRUE) {
  echo "cita eliminada exitosamente";
} else {
  echo "Error al eliminar la cita: " . $mysqli->error;
}

$mysqli->close();
?>