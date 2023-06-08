<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$sql = "SELECT * FROM usuario";
$query = $mysqli->query($sql);

$datos = array();

while($resultado = $query->fetch_assoc()) {
  $id_usuario = $resultado['id_usuario'];
  unset($resultado['id_usuario']);

  // Obtener la cantidad de mascotas de cada usuario
  $sql_mascotas = "SELECT COUNT(*) AS num_mascotas FROM mascotas WHERE id_usuario = $id_usuario";
  $query_mascotas = $mysqli->query($sql_mascotas);
  $num_mascotas = $query_mascotas->fetch_assoc()['num_mascotas'];
  //$imagen = base64_encode($resultado['foto_usuario']);
  $datos[$id_usuario] = array(
    'usuario' => $resultado['nombre_usuario'],
    'id_usuario' => $id_usuario,
    'estatus_usuario' => $resultado['estatus_usuario'],
    'baja_usuario' => $resultado['baja_usuario'],
    'num_mascotas' => $num_mascotas,
    //'foto_usuario' => $imagen  // Agregar el número de mascotas al arreglo de cada usuario
    'foto_usuario' => $resultado['foto_usuario'],
  );
}

echo json_encode(array_values($datos));



/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$sql = "SELECT usuario.*, mascotas.* FROM usuario LEFT JOIN mascotas ON usuario.id_usuario = mascotas.id_usuario";
$query = $mysqli->query($sql);

$datos = array();

while($resultado = $query->fetch_assoc()) {
  $id_usuario = $resultado['id_usuario'];
  unset($resultado['id_usuario']);

  $id_mascota = $resultado['id_mascota'];
  unset($resultado['id_mascota']);

  if (!isset($datos[$id_usuario])) {
    $datos[$id_usuario] = array(
      'usuario' => $resultado['nombre_usuario'],
      'id_usuario' => $id_usuario,
      'estatus_usuario' => $resultado['estatus_usuario'],
      'baja_usuario' => $resultado['baja_usuario'],
      'mascotas' => array(),
    );
  }

  unset($resultado['nombre_usuario']);
  unset($resultado['estatus_usuario']);
  unset($resultado['baja_usuario']);

  if ($id_mascota !== null) {
    $datos[$id_usuario]['mascotas'][$id_mascota] = array(
      'nombre_mascota' => $resultado['nombre_mascota'],
    );
  }
}

echo json_encode(array_values($datos));*/
