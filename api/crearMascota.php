<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$nombre_mascota = $data["nombre_mascota"];
$color_mascota = $data["color_mascota"];
$raza_mascota = $data["raza_mascota"];
$especie_mascota = $data["especie_mascota"];
$fecha_nacimiento_mascota = $data["fecha_nacimiento_mascota"];// en formato año-mes- dia
$sexo_mascota = $data["sexo_mascota"];
$id_usuario = $data["id_usuario"];


$sql = "INSERT INTO mascotas (nombre_mascota, color_mascota, raza_mascota, especie_mascota,fecha_nacimiento_mascota, sexo_mascota,id_usuario) 
        VALUES ('$nombre_mascota', '$color_mascota', '$raza_mascota', '$especie_mascota', '$fecha_nacimiento_mascota', '$sexo_mascota', '$id_usuario')";

if ($mysqli->query($sql) === TRUE) {
  echo "Mascota creada exitosamente";
} else {
  echo "Error al crear la mascota: " . $mysqli->error;
}

$mysqli->close();

?>

