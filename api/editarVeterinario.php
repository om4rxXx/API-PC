<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require "config.php";

// Recuperar datos de la solicitud PUT
$data = json_decode(file_get_contents("php://input"), true);

$id_veterinario = 1;
$nombre_veterinario =$_GET["nombre_veterinario"];
$apellido_veterinario = $_GET["apellido_veterinario"];
$telefono_veterinario = $_GET["telefono_veterinario"];
$email_veterinario = $_GET["email_veterinario"];
$estado_veterinario = $_GET["estado_veterinario"];
$ciudad_veterinario = $_GET["ciudad_veterinario"];
$colonia_veterinario = $_GET["colonia_veterinario"];
$cp_veterinario = $_GET["cp_veterinario"];
$calle_veterinario = $_GET["calle_veterinario"];
$num_ext_veterinario = $_GET["num_ext_veterinario"];
$password_veterinario = $_GET["password_veterinario"];
$foto_veterinario = $_GET["foto_veterinario"];

$datosActualizados = array();
if (!empty($nombre_veterinario)) {
  $datosActualizados["nombre_veterinario"] = $nombre_veterinario;
}
if (!empty($apellido_veterinario)) {
  $datosActualizados["apellido_veterinario"] = $apellido_veterinario;
}
if (!empty($telefono_veterinario)) {
  $datosActualizados["telefono_veterinario"] = $telefono_veterinario;
}
if (!empty($email_veterinario)) {
  $datosActualizados["email_veterinario"] = $email_veterinario;
}
if (!empty($estado_veterinario)) {
  $datosActualizados["estado_veterinario"] = $estado_veterinario;
}
if (!empty($ciudad_veterinario)) {
  $datosActualizados["ciudad_veterinario"] = $ciudad_veterinario;
}
if (!empty($colonia_veterinario)) {
  $datosActualizados["colonia_veterinario"] = $colonia_veterinario;
}
if (!empty($cp_veterinario)) {
  $datosActualizados["cp_veterinario"] = $cp_veterinario;
}
if (!empty($calle_veterinario)) {
  $datosActualizados["calle_veterinario"] = $calle_veterinario;
}
if (!empty($num_ext_veterinario)) {
  $datosActualizados["num_ext_veterinario"] = $num_ext_veterinario;
}
if (!empty($password_veterinario)) {
  $datosActualizados["password_veterinario"] = $password_veterinario;
}
if (!empty($foto_veterinario)) {
  $foto_veterinario = base64_decode($foto_veterinario); // Decodificar la imagen en base64
  $datosActualizados["foto_veterinario"] = $foto_veterinario;
}

// ...

if (!empty($datosActualizados)) {
  $updateValues = array();
  foreach($datosActualizados as $key => $value) {
    if ($key === "foto_veterinario") {
      // Para el campo de foto, debes

      // Para el campo de foto, debes usar una consulta preparada
      $stmt = $mysqli->prepare("UPDATE veterinario SET foto_veterinario = ? WHERE id_veterinario = ?");
      $stmt->bind_param("si", $value, $id_veterinario);
      $stmt->send_long_data(0, $value);
      $stmt->execute();
      $stmt->close();
    } else {
      $updateValues[] = "$key = '$value'";
    }
  }
  $updateValuesString = implode(", ", $updateValues);
  
  $sql = "UPDATE veterinario SET $updateValuesString WHERE id_veterinario = $id_veterinario";
  if ($mysqli->query($sql) === TRUE) {
    echo "Veterinario actualizado exitosamente";
  } else {
    echo "Error al actualizar el veterinario: " . $mysqli->error;
  }
}

