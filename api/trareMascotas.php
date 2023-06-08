<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_usuario = $_GET["id_usuario"];

// Obtener todos las mascotas asociadas al usuario
$sql = "SELECT * FROM mascotas WHERE id_usuario = $id_usuario";
$query = $mysqli->query($sql);

$mascotas = array();

if($query && $query->num_rows) {
  while($resultado = $query->fetch_assoc()) {
    //$imagen = base64_encode($resultado['foto_mascota']);
    $mascota = array(
      'id_mascota' => $resultado['id_mascota'],
      'nombre_mascota' => $resultado['nombre_mascota'],
      'raza_mascota' => $resultado['raza_mascota'],
      'color_mascota' => $resultado['color_mascota'],
      'fecha_nacimiento_mascota' => $resultado['fecha_nacimiento_mascota'],
      'padecimientos_mascota' => $resultado['padecimientos_mascota'],
      'especie_mascota' => $resultado['especie_mascota'],
      'sexo_mascota' => $resultado['sexo_mascota'],
      'foto_mascota' => $resultado['foto_mascota'] 
      
      
    );
    
    $mascotas[] = $mascota; // Agregar la mascota al array de mascotas
  }
}

echo json_encode($mascotas);