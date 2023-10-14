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
    
    $idempleado = filter_input(INPUT_POST, 'idempleado', FILTER_VALIDATE_INT);
    $fechacontrol_empleados = filter_input(INPUT_POST, 'fechacontrol_empleados', FILTER_SANITIZE_STRING) ?? '';
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING) ?? '';
    
    if (empty($idempleado)) {
        $errors['idempleado'] = "El ID de empleado es requerido.";
    }
    
    if (empty($fechacontrol_empleados)) {
        $errors['fechacontrol_empleados'] = "La fecha de control de empleados es requerida.";
    }

    if (empty($errors)) {
        $idlistacontrol = filter_input(INPUT_POST, 'idlistacontrol', FILTER_VALIDATE_INT);

        if (!$idlistacontrol) {
            echo json_encode(["message" => "ID de lista inválido.", "success" => false]);
            exit;
        }

        // Actualizar la lista de control de empleados
        $sql = "UPDATE listacontrolempleados SET idempleado=?, fechacontrol_empleados=?, descripcion=? WHERE idlistacontrol=?";
        
        try {
            $stmt = $db->prepare($sql);
            $resultado = $stmt->execute([$idempleado, $fechacontrol_empleados, $descripcion, $idlistacontrol]);
            
            if ($resultado && $stmt->rowCount() > 0) {
                echo json_encode(["message" => "Control de empleados actualizado con éxito.", "success" => true]);
            } else {
                echo json_encode(["message" => "Error al actualizar o ningún dato cambió.", "success" => false]);
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
