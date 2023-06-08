<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$nombre_veterinario = $data["nombre_veterinario"];
$apellido_veterinario = $data["apellido_veterinario"];
$telefono_veterinario = $data["telefono_veterinario"];
$email_veterinario = $data["email_veterinario"];
$estado_veterinario = $data["estado_veterinario"];
$ciudad_veterinario = $data["ciudad_veterinario"];
$colonia_veterinario = $data["colonia_veterinario"];
$cp_veterinario = $data["cp_veterinario"];
$calle_veterinario = $data["calle_veterinario"];
$num_ext_veterinario = $data["num_ext_veterinario"];
$password_veterinario = $data["password_veterinario"];

$sql = "INSERT INTO veterinario (nombre_veterinario, apellido_veterinario, telefono_veterinario, email_veterinario, estado_veterinario, ciudad_veterinario, colonia_veterinario, cp_veterinario, calle_veterinario, num_ext_veterinario, password_veterinario) 
        VALUES ('$nombre_veterinario', '$apellido_veterinario', '$telefono_veterinario', '$email_veterinario', '$estado_veterinario', '$ciudad_veterinario', '$colonia_veterinario', '$cp_veterinario', '$calle_veterinario', '$num_ext_veterinario', '$password_veterinario')";

if ($mysqli->query($sql) === TRUE) {
  echo "Veterinario creado exitosamente";
} else {
  echo "Error al crear el veterinario: " . $mysqli->error;
}

$mysqli->close();
?>

//nombre_veterinario, apellido_veterinario, telefono_veterinario , email_veterinario, estado_veterinario, ciudad_veterinario, colonia_veterinario, cp_veterinario, calle_veterinario, num_ext_veterinario, password_veterinario