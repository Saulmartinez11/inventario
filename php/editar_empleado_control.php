<?php

session_start();

header("Content-Type: application/json");

include "conexion.php";

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["message" => "Por favor, inicia sesión primero.", "success" => false]);
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $primer_nombre = filter_input(INPUT_POST, 'primer_nombre_empleado', FILTER_SANITIZE_STRING) ?? '';
    $segundo_nombre = filter_input(INPUT_POST, 'segundo_nombre_empleado', FILTER_SANITIZE_STRING) ?? '';
    $primer_apellido = filter_input(INPUT_POST, 'primer_apellido_empleado', FILTER_SANITIZE_STRING) ?? '';
    $segundo_apellido = filter_input(INPUT_POST, 'segundo_apellido_empleado', FILTER_SANITIZE_STRING) ?? '';
    $edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT) ?? '';
    $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING) ?? '';
    $id_usuario = $_SESSION['id_usuario'];
    
    if(empty($primer_nombre)) {
        $errors['primer_nombre_empleado'] = "El primer nombre es requerido.";
    }
    if(empty($segundo_nombre)) {
        $errors['segundo_nombre_empleado'] = "El segundo nombre es requerido.";
    }
    

    if (empty($errors)) {
        $id_empleado = filter_input(INPUT_POST, 'id_empleado', FILTER_VALIDATE_INT);

        if (!$id_empleado) {
            echo json_encode(["message" => "ID de empleado inválido.", "success" => false]);
            exit;
        }

        $sql = "UPDATE empleados_construccion SET primer_nombre_empleado=?, segundo_nombre_empleado=?, primer_apellido_empleado=?, segundo_apellido_empleado=?, edad=?, cargo=? WHERE id_empleado=?";
        
        try {
            $stmt = $db->prepare($sql);
            $resultado = $stmt->execute([$primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $edad, $cargo, $id_empleado]);
            
            if ($resultado && $stmt->rowCount() > 0) {
                echo json_encode(["message" => "Empleado actualizado con éxito.", "success" => true]);
            } else {
                echo json_encode(["message" => "Error al actualizar el empleado o ningún dato cambió.", "success" => false]);
            }
            exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo json_encode(["message" => "Error en la base de datos.", "success" => false]);
            exit;
        }
    } else {
        echo json_encode(["message" => implode(". ", $errors), "success" => false]);
        exit;
    }
}
?>
