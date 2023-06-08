<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
require "config.php";

// Leer los datos del cuerpo de la petición
$input = file_get_contents('php://input');
$data = json_decode($input, true);

//$email_veterinario = "wilson030082017@gmail.com";
//$password_veterinario = "Holaho0$";
$email_veterinario = $data["email_veterinario"];

$password_veterinario = $data["password_veterinario"];

// Verificar los datos del inicio de sesión
$sql = "SELECT * FROM veterinario WHERE email_veterinario = '$email_veterinario' AND password_veterinario = '$password_veterinario'";
$query = $mysqli->query($sql);

if ($query && $query->num_rows) {
  // Los datos son válidos, crear una cookie
  $cookie_value = uniqid();
  $cookie_expiration = time() + (8 * 60 * 60); // 8 horas
  setcookie("login_cookie", $cookie_value, $cookie_expiration);

  // Mostrar el valor de la cookie
  //echo "La cookie de inicio de sesión ha sido creada. Su valor es: " . $cookie_value;
  echo json_encode($cookie_value);
  
  
} else {
  // Los datos no son válidos, mostrar un mensaje de error
  echo "XD";
}

?>
