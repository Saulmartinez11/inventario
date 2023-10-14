<?php
session_start();  

include "conexion.php";  

if (!isset($_SESSION['id_usuario'])) {
    echo "Por favor, inicia sesión primero.";
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $primer_nombre = filter_input(INPUT_POST, 'primer_nombre', FILTER_SANITIZE_STRING) ?? '';
    $segundo_nombre = filter_input(INPUT_POST, 'segundo_nombre', FILTER_SANITIZE_STRING) ?? '';
    $primer_apellido = filter_input(INPUT_POST, 'primer_apellido', FILTER_SANITIZE_STRING) ?? '';
    $segundo_apellido = filter_input(INPUT_POST, 'segundo_apellido', FILTER_SANITIZE_STRING) ?? '';
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT) ?? '';
    $nombre_usuario = filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING) ?? '';
    $contrasena = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_STRING) ?? ''; // Añadido campo contraseña
    $id_usuario = $_SESSION['id_usuario'];  
    
    // Validaciones
    if(empty($primer_nombre) || empty($segundo_nombre) || empty($primer_apellido) || empty($segundo_apellido) || empty($edad) || empty($nombre_usuario) || empty($contrasena)) {
        header("Location: ../Editar-usuario.html?error=Ocurrio un error, algún campo vacío o edad con letra.");
        exit;
    }

    if(!is_numeric($edad) || $edad < 0) {
        header("Location: ../Editar-usuario.html?error=Edad no correcta.");
        exit;
    }
    
    // Hash de la contraseña antes de guardarla en la base de datos
    $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

    // Modificación de la consulta SQL para incluir la actualización de la contraseña
    $sql = "UPDATE usuarios SET primer_nombre=?, segundo_nombre=?, primer_apellido=?, segundo_apellido=?, edad=?, nombre_usuario=?, contraseña=? WHERE id_usuario=?";

    $stmt = $db->prepare($sql);
    $resultado = $stmt->execute([$primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $nombre_usuario, $contrasena_hasheada, $id_usuario]);

    if ($resultado) {
        echo "Perfil actualizado con éxito";
    } else {
        echo "Error al actualizar el perfil.";
    }
    
    header("Location: ../Usuario.html");
    exit;  
}
?>
