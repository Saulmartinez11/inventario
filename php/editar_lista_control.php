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
    
    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING) ?? '';
    $producto = filter_input(INPUT_POST, 'producto', FILTER_SANITIZE_STRING) ?? '';
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING) ?? '';
    $fechacontrol = filter_input(INPUT_POST, 'fechacontrol', FILTER_SANITIZE_STRING) ?? '';
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT) ?? '';
    $id_usuario = $_SESSION['id_usuario'];
    
    if(empty($tipo)) {
        $errors['tipo'] = "El tipo es requerido.";
    }
    if(empty($producto)) {
        $errors['producto'] = "El producto es requerido.";
    }

    if (empty($errors)) {
        $id_lista = filter_input(INPUT_POST, 'id_lista', FILTER_VALIDATE_INT);

        if (!$id_lista) {
            echo json_encode(["message" => "ID de lista inválido.", "success" => false]);
            exit;
        }

        // Obtener información actual de la lista.
        $stmt = $db->prepare("SELECT * FROM lista_control WHERE id_lista = ?");
        $stmt->execute([$id_lista]);
        $listaActual = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si el producto ya existe en la tabla 'productos'
        $stmt = $db->prepare("SELECT id_producto, cantidad FROM productos WHERE nombre_producto = ?");
        $stmt->execute([$producto]);
        $productoExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si el producto no existe, añadirlo a 'productos'
        if(!$productoExistente) {
            $stmt = $db->prepare("INSERT INTO productos (nombre_producto, cantidad, codcategoria) VALUES (?, ?, ?)");
            $stmt->execute([$producto, $cantidad, $tipo]);
        } else {
            // Si el producto ya existe, actualizar la cantidad y el codcategoria en 'productos'
            $nuevaCantidad = $cantidad - $listaActual['cantidad']; // Calcular la diferencia.
            $stmt = $db->prepare("UPDATE productos SET cantidad = cantidad + ?, codcategoria = ? WHERE id_producto = ?");
            $stmt->execute([$nuevaCantidad, $tipo, $productoExistente['id_producto']]);
        }

        // Actualizar la lista de control
        $sql = "UPDATE lista_control SET tipo=?, producto=?, descripcion=?, fechacontrol=?, cantidad=? WHERE id_lista=?";
        
        try {
            $stmt = $db->prepare($sql);
            $resultado = $stmt->execute([$tipo, $producto, $descripcion, $fechacontrol, $cantidad, $id_lista]);
            
            if ($resultado && $stmt->rowCount() > 0) {
                echo json_encode(["message" => "Control y productos actualizados con éxito.", "success" => true]);
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
