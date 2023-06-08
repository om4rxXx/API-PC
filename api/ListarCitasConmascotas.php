<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require "config.php";

$sql = "SELECT cita.id_cita, cita.tipo_cita, cita.descripcion_cita, cita.observaciones_cita, cita.fecha_cita, cita.hora_cita, 
            mascotas.nombre_mascota, mascotas.especie_mascota, mascotas.raza_mascota, mascotas.color_mascota, mascotas.padecimientos_mascota, mascotas.fecha_nacimiento_mascota, mascotas.sexo_mascota, mascotas.foto_mascota,
            usuario.nombre_usuario, usuario.apellido_usuario,  mascotas.id_mascota
        FROM cita
        JOIN mascotas ON cita.id_mascota = mascotas.id_mascota
        JOIN usuario ON mascotas.id_usuario = usuario.id_usuario
        WHERE cita.estatus_cita = 0
        ORDER BY cita.fecha_cita ASC, cita.hora_cita ASC";


$query = $mysqli->query($sql);

$citas = array();

if($query && $query->num_rows) {
    
  while($resultado = $query->fetch_assoc()) {
    //$imagen = base64_encode($resultado['foto_mascota']);
    $citas[] = array(
      'id_cita' => $resultado['id_cita'],
      'tipo_cita' => $resultado['tipo_cita'],
      'descripcion_cita' => $resultado['descripcion_cita'],
      'observaciones_cita' => $resultado['observaciones_cita'],
      'fecha_cita' => $resultado['fecha_cita'],
      'hora_cita' => $resultado['hora_cita'],
      'nombre_mascota' => $resultado['nombre_mascota'],
      'especie_mascota' => $resultado['especie_mascota'],
      'raza_mascota' => $resultado['raza_mascota'],
      'color_mascota' => $resultado['color_mascota'],
      'padecimientos_mascota' => $resultado['padecimientos_mascota'],
      'fecha_nacimiento_mascota' => $resultado['fecha_nacimiento_mascota'],
      'sexo_mascota' => $resultado['sexo_mascota'],
      'nombre_usuario' => $resultado['nombre_usuario'],
      'id_mascota'=> $resultado['id_mascota'],
      //'foto_mascota' => $resultado['foto_mascota'],
      'apellido_usuario'=>$resultado['apellido_usuario'] 
      //'foto_mascota' => $imagen 
    );
   
  }
}

echo json_encode($citas);
?>
