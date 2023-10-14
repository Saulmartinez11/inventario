<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();  
header('Content-Type: application/json');
include "conexion.php";  

 
// Verificación de la sesión y permisos del usuario
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 'administrador') {
    echo json_encode(["success" => false, "message" => "No tienes permisos para realizar esta acción."]);
    exit;
}
 
// Verificación del método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Filtrado de las entradas del usuario
    $primer_nombre = filter_input(INPUT_POST, 'primer_nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $segundo_nombre = filter_input(INPUT_POST, 'segundo_nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $primer_apellido = filter_input(INPUT_POST, 'primer_apellido', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $segundo_apellido = filter_input(INPUT_POST, 'segundo_apellido', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT) ?? '';
    $nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $contraseña = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? '';
    $id_usuario_edit = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
  
    // Validación de las entradas del usuario
    if(empty($contraseña)) {
        echo json_encode(["success" => false, "message" => "La contraseña es requerida."]);
        exit;
    }

    if(empty($primer_nombre) || empty($segundo_nombre) || empty($primer_apellido) || empty($segundo_apellido) || empty($edad) || empty($nombre_usuario) || empty($cargo) || empty($contraseña)) {
        echo json_encode(["success" => false, "message" => "Ocurrió un error: algún campo está vacío o la edad no es válida."]);
        exit;
    }

    if(!is_numeric($edad) || $edad < 0) {
        echo json_encode(["success" => false, "message" => "Edad no correcta."]);
        exit;
    } 

    // Hash de la contraseña
    $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Consulta SQL para actualizar el usuario
    $sql = "UPDATE usuarios SET primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=?, edad=?, nombre_usuario=?, cargo=?, contraseña=? WHERE id_usuario=?";

    $stmt = $db->prepare($sql);
    $resultado = $stmt->execute([$primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $nombre_usuario, $cargo, $contraseña_hasheada, $id_usuario_edit]);
    
    // Resultado de la operación
    if ($resultado) {
        echo json_encode(["success" => true, "message" => "Perfil actualizado con éxito"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al actualizar el perfil."]);
    }
    exit;
}
?>
