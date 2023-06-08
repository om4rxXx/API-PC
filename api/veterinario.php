<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_veterinario = 1;

// Obtener la información del veterinario
$sql_veterinario = "SELECT * FROM veterinario WHERE id_veterinario = $id_veterinario";
$query_veterinario = $mysqli->query($sql_veterinario);

$veterinario = array();

if($query_veterinario && $query_veterinario->num_rows) {
  $resultado_veterinario = $query_veterinario->fetch_assoc();

  // Leer los datos de la imagen y convertirlos a base64
  $imagen_veterinario =($resultado_veterinario['foto_veterinario']);

  // Construir el array con los datos del veterinario y la imagen
  $veterinario = array(
    'id_veterinario' => $resultado_veterinario['id_veterinario'],
    'nombre_veterinario' => $resultado_veterinario['nombre_veterinario'],
    'apellido_veterinario' => $resultado_veterinario['apellido_veterinario'],
    'telefono_veterinario' => $resultado_veterinario['telefono_veterinario'],
    'email_veterinario' => $resultado_veterinario['email_veterinario'],
    'estado_veterinario' => $resultado_veterinario['estado_veterinario'],
    'ciudad_veterinario' => $resultado_veterinario['ciudad_veterinario'],
    'colonia_veterinario' => $resultado_veterinario['colonia_veterinario'],
    'cp_veterinario' => $resultado_veterinario['cp_veterinario'],
    'calle_veterinario' => $resultado_veterinario['calle_veterinario'],
    'num_ext_veterinario' => $resultado_veterinario['num_ext_veterinario'],
    'password_veterinario' => $resultado_veterinario['password_veterinario'],
    'foto_veterinario' => $imagen_veterinario
  );

  // Obtener el número de usuarios
  $sql_usuarios = "SELECT COUNT(*) as num_usuarios FROM usuario";
  $query_usuarios = $mysqli->query($sql_usuarios);

  if($query_usuarios && $query_usuarios->num_rows) {
    $resultado_usuarios = $query_usuarios->fetch_assoc();
    $veterinario['num_usuarios'] = $resultado_usuarios['num_usuarios'];
  }
  $sql_cita = "SELECT COUNT(*) as num_citas FROM cita c WHERE c.estatus_cita = 0";
  $query_cita = $mysqli->query($sql_cita);

  if($query_cita && $query_cita->num_rows) {
    $resultado_cita = $query_cita->fetch_assoc();
    $veterinario['num_citas'] = $resultado_cita['num_citas'];
  }
}

echo json_encode($veterinario);

