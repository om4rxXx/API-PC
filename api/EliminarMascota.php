<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_mascota = $_GET["id_mascota"];

$sql = "DELETE FROM mascotas WHERE id_mascota = $id_mascota";

if ($mysqli->query($sql) === TRUE) {
  echo "Mascota eliminada exitosamente";
} else {
  echo "Error al eliminar la mascota: " . $mysqli->error;
}

$mysqli->close();
?>