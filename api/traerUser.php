<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_usuario = $_GET["id_usuario"];

$sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
$query = $mysqli->query($sql);

$usuario = array();

if($query && $query->num_rows) {
  $resultado = $query->fetch_assoc();
  
  // Leer los datos de la imagen y convertirlos a base64
 // $imagen = base64_encode($resultado['foto_usuario']);
  
  $usuario = array(
    'id_usuario' => $resultado['id_usuario'],
    'nombre_usuario' => $resultado['nombre_usuario'],
    'apellido_usuario' => $resultado['apellido_usuario'],
    'telefono_usuario'=>$resultado['telefono_usuario'],
    'email_usuario'=>$resultado['email_usuario'],
    'foto_usuario' => $resultado['foto_usuario'] // Agregar los datos de la imagen al objeto JSON
  );
  
}

echo json_encode($usuario);


/*
$id_usuario = $_GET['id_usuario'];
// para probar utilizar este   $id_usuario = 4;

$sql = "SELECT * FROM usuario INNER JOIN mascotas ON usuario.id_usuario = mascotas.id_usuario WHERE usuario.id_usuario = $id_usuario";
$query = $mysqli->query($sql);

$datos = array();

while($resultado = $query->fetch_assoc()) {
  $id_usuario = $resultado['id_usuario'];
  unset($resultado['id_usuario']);

  if (!isset($datos[$id_usuario])) {
    $datos[$id_usuario] = array(
      'usuario' => $resultado['nombre_usuario'],
      'mascotas' => array(),
    );
  }

  unset($resultado['nombre_usuario']);

  $datos[$id_usuario]['mascotas'][] = $resultado;
}

echo json_encode(array_values($datos));
*/