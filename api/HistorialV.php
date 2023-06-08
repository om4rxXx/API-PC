<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_mascota = $_GET["id_mascota"];

$sql = "SELECT consulta.*, cita.fecha_cita
        FROM consulta 
        JOIN cita ON consulta.id_cita = cita.id_cita 
        WHERE consulta.id_mascota = $id_mascota AND LOWER(consulta.tipo_consulta) = 'vacunacion'
        ORDER BY cita.fecha_cita DESC"; // Se ordena por fecha de cita de manera descendente (de la más reciente a la más antigua)

$query = $mysqli->query($sql);

$consultas = array();

if($query && $query->num_rows) {
  while($resultado = $query->fetch_assoc()) {
    $consulta = array(
      'id_consulta' => $resultado['id_consulta'],
      'tipo_consulta' => $resultado['tipo_consulta'],
      'descripcion_consulta' => $resultado['descripcion_consulta'],
      'peso_consulta' => $resultado['peso_consulta'],
      'producto_consulta' => $resultado['producto_consulta'],
      'aplico_consulta' => $resultado['aplico_consulta'],
      'observaciones_consulta' => $resultado['observaciones_consulta'],
      'fecha_cita' => $resultado['fecha_cita']
    );
    array_push($consultas, $consulta);
  }
}

echo json_encode($consultas);


/* 
puede que jale trae tambien la fecha 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

$id_mascota = 1;

$sql = "SELECT c.fecha_cita, co.* 
        FROM consulta co
        INNER JOIN cita c ON co.id_cita = c.id_cita 
        WHERE co.id_mascota = $id_mascota 
        AND LOWER(co.tipo_consulta) = 'vacunacion'";
$query = $mysqli->query($sql);

$consultas = array();

if($query && $query->num_rows) {
  while($resultado = $query->fetch_assoc()) {
    $consulta = array(
      'id_consulta' => $resultado['id_consulta'],
      'tipo_consulta' => $resultado['tipo_consulta'],
      'descripcion_consulta' => $resultado['descripcion_consulta'],
      'peso_consulta' => $resultado['peso_consulta'],
      'producto_consulta' => $resultado['producto_consulta'],
      'aplico_consulta' => $resultado['aplico_consulta'],
      'observaciones_consulta' => $resultado['observaciones_consulta'],
      'fecha_cita' => $resultado['fecha_cita']
    );
    array_push($consultas, $consulta);
  }
}

echo json_encode($consultas);*/

