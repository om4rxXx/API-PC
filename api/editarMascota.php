<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_mascota = $_GET["id_mascota"];
$nombre_mascota = $_GET["nombre_mascota"];
$color_mascota = $_GET["color_mascota"];
$raza_mascota = $_GET["raza_mascota"];
$padecimientos_mascota = $_GET["padecimientos_mascota"];

$datosActualizados = array();
if (!empty($nombre_mascota)) {
  $datosActualizados["nombre_mascota"] = $nombre_mascota;
}
if (!empty($color_mascota)) {
  $datosActualizados["color_mascota"] = $color_mascota;
}
if (!empty($raza_mascota)) {
  $datosActualizados["raza_mascota"] = $raza_mascota;
}
if (!empty($padecimientos_mascota)) {
  $datosActualizados["padecimientos_mascota"] = $padecimientos_mascota;
}

if (empty($datosActualizados)) {
  echo "No se proporcionaron datos para actualizar la mascota";
} else {
  $updateValues = array();
  foreach($datosActualizados as $key => $value) {
    $updateValues[] = "$key = '$value'";
  }
  $updateValuesString = implode(", ", $updateValues);
  
  $sql = "UPDATE mascotas SET $updateValuesString WHERE id_mascota = $id_mascota";
  
  if ($mysqli->query($sql) === TRUE) {
    echo "Mascota actualizada exitosamente";
  } else {
    echo "Error al actualizar la mascota: " . $mysqli->error;
  }
}

$mysqli->close();