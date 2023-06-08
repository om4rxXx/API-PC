<?php



header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$foto_veterinario = $data["foto_veterinario"];

$id_veterinario = 1; // El ID del veterinario es fijo en este ejemplo
// El estatus de la cita se establece en 0 por defecto

$sql = "UPDATE  veterinario  SET foto_veterinario = '$foto_veterinario' WHERE id_veterinario = '$id_veterinario'";

if ($mysqli->query($sql) === TRUE) {
  echo "Cita creada exitosamente";
} else {
  echo "Error al crear la cita: " . $mysqli->error;
}

$mysqli->close();
?>