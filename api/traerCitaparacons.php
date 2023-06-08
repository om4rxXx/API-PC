<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_cita = $_GET["id_cita"];

// Obtener la información de la cita
$sql_cita = "SELECT cita.tipo_cita, cita.descripcion_cita, cita.fecha_cita, cita.hora_cita, cita.id_cita, 
            mascotas.nombre_mascota, mascotas.raza_mascota, cita.id_mascota, cita.id_veterinario
        FROM cita
        JOIN mascotas ON cita.id_mascota = mascotas.id_mascota
        WHERE cita.id_cita = $id_cita";
$query_cita = $mysqli->query($sql_cita);

$cita = array();

if($query_cita && $query_cita->num_rows) {
  $resultado_cita = $query_cita->fetch_assoc();

  // Obtener la información del veterinario asignado a la cita
  $id_veterinario = $resultado_cita['id_veterinario'];
  $sql_veterinario = "SELECT nombre_veterinario, apellido_veterinario, foto_veterinario FROM veterinario WHERE id_veterinario = $id_veterinario";
  $query_veterinario = $mysqli->query($sql_veterinario);

  if($query_veterinario && $query_veterinario->num_rows) {
    $resultado_veterinario = $query_veterinario->fetch_assoc();

    // Leer los datos de la imagen del veterinario y convertirlos a base64
    $imagen_veterinario = base64_encode($resultado_veterinario['foto_veterinario']);

    // Construir el array con los datos de la cita, la mascota y el veterinario
    $cita = array(
      'tipo_cita' => $resultado_cita['tipo_cita'],
      'descripcion_cita' => $resultado_cita['descripcion_cita'],
      'fecha_cita' => $resultado_cita['fecha_cita'],
      'hora_cita' => $resultado_cita['hora_cita'],
      'nombre_mascota' => $resultado_cita['nombre_mascota'],
      'raza_mascota' => $resultado_cita['raza_mascota'],
      'id_mascota' => $resultado_cita['id_mascota'],
      'id_cita' => $resultado_cita['id_cita'],
      'id_veterinario' => $resultado_cita['id_veterinario'],
      'nombre_veterinario' => $resultado_veterinario['nombre_veterinario'],
      'apellido_veterinario' => $resultado_veterinario['apellido_veterinario'],
      'foto_veterinario' => $imagen_veterinario
    );
  }
}

echo json_encode($cita);
