<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$email_veterinario = $data['email_veterinario'];

// Obtener la información del veterinario
$sql_veterinario = "SELECT * FROM veterinario WHERE email_veterinario = '$email_veterinario'";
$query_veterinario = $mysqli->query($sql_veterinario);

$veterinario = array();

if($query_veterinario && $query_veterinario->num_rows) {
  $resultado_veterinario = $query_veterinario->fetch_assoc();

  // Leer los datos de la imagen y convertirlos a base64
  

  // Construir el array con los datos del veterinario y la imagen
  $veterinario = array(
    
    'email_veterinario' => $resultado_veterinario['email_veterinario'],
    
    
    'password_veterinario' => $resultado_veterinario['password_veterinario'],
    
  );

  
}

echo json_encode($veterinario);



//