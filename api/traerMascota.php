<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_mascota = $_GET["id_mascota"];

// Obtener la información de la mascota y el dueño
$sql = "SELECT m.*, u.id_usuario, u.nombre_usuario, u.apellido_usuario, u.foto_usuario FROM mascotas m
        JOIN usuario u ON m.id_usuario = u.id_usuario
        WHERE m.id_mascota = $id_mascota";
$query = $mysqli->query($sql);

$mascota = array();

if ($query && $query->num_rows) {
    $resultado = $query->fetch_assoc();

    // Leer los datos de la imagen y convertirlos a base64
   // $imagen_mascota = base64_encode($resultado['foto_mascota']);
    //$imagen_usuario = base64_encode($resultado['foto_usuario']);

    // Construir el array con los datos de la mascota y del usuario dueño
    $mascota = array(
        'id_mascota' => $resultado['id_mascota'],
        'nombre_mascota' => $resultado['nombre_mascota'],
        'raza_mascota' => $resultado['raza_mascota'],
        'fecha_nacimiento_mascota' => $resultado['fecha_nacimiento_mascota'],
        'sexo_mascota' => $resultado['sexo_mascota'],
        'foto_mascota' => $resultado['foto_mascota'],
        'padecimientos_mascota' => $resultado['padecimientos_mascota'],
        'nombre_usuario' => $resultado['nombre_usuario'],
        'especie_mascota' => $resultado['especie_mascota'],
        'apellido_usuario' => $resultado['apellido_usuario'],
        'foto_usuario' =>  $resultado['foto_usuario'],
        'id_usuario' => $resultado['id_usuario']
    );
}

echo json_encode($mascota);


/*
$id_mascota = 1;

$sql = "SELECT * FROM mascotas WHERE id_mascota = $id_mascota";
$query = $mysqli->query($sql);

$mascota = array();

if($query_mascota && $query_mascota->num_rows) {
    $resultado_mascota = $query_mascota->fetch_assoc();
  
  // Leer los datos de la imagen y convertirlos a base64
  $imagen = base64_encode($resultado['foto_mascota']);
  
  $id_usuario = $resultado_mascota['id_usuario'];
  $sql_usuario = "SELECT nombre_usuario, apellido_usuario FROM usuario WHERE id_usuario = $id_usuario";
  $query_usuario = $mysqli->query($sql_usuario);

  if($query_usuario && $query_usuario->num_rows) {
    $resultado_usuario = $query_usuario->fetch_assoc();

  $mascota = array(
    'id_mascota' => $resultado['id_mascota'],
    'nombre_mascota' => $resultado['nombre_mascota'],
    'raza_mascota' => $resultado['raza_mascota'],
    'fecha_nacimiento_mascota' => $resultado['fecha_nacimiento_mascota'],
    'sexo_mascota' => $resultado['sexo_mascota'],
    'foto_mascota' => $imagen // Agregar los datos de la imagen al objeto JSON
    'nombre_usuario' => $resultado_usuario['nombre_usuario'],
    'apellido_usuario' => $resultado_usuario['apellido_usuario']
);
}
}

echo json_encode($mascota);*/


