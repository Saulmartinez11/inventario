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
    
    $codcategoria = filter_input(INPUT_POST, 'codcategoria', FILTER_SANITIZE_STRING) ?? '';
    $nombre_producto = filter_input(INPUT_POST, 'nombre_producto', FILTER_SANITIZE_STRING) ?? '';
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_STRING) ?? '';
    $id_usuario = $_SESSION['id_usuario'];
    
    if(empty($codcategoria)) {
        $errors['codcategoria'] = "La categoria es requerida.";
    }
    if(empty($nombre_producto)) {
        $errors['nombre_producto'] = "El producto es requerido.";
    }
    if(empty($cantidad)) {
        $errors['cantidad'] = "La cantidad es requerida.";
    }
    

    if (empty($errors)) {
        $id_producto = filter_input(INPUT_POST, 'id_producto', FILTER_VALIDATE_INT);

        if (!$id_producto) {
            echo json_encode(["message" => "ID de empleado inválido.", "success" => false]);
            exit;
        }

        $sql = "UPDATE productos SET codcategoria=?, nombre_producto=?, cantidad=? WHERE id_producto=?";
        
        try {
            $stmt = $db->prepare($sql);
            $resultado = $stmt->execute([$codcategoria, $nombre_producto, $cantidad, $id_producto]);
            
            if ($resultado && $stmt->rowCount() > 0) {
                echo json_encode(["message" => "Producto actualizado con éxito.", "success" => true]);
            } else {
                echo json_encode(["message" => "Error al actualizar el producto o ningún dato cambió.", "success" => false]);
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