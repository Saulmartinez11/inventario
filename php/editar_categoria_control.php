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
    
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING) ?? '';
    $id_usuario = $_SESSION['id_usuario'];
    
    if(empty($categoria)) {
        $errors['categoria'] = "El primer nombre es requerido.";
    }

    if (empty($errors)) {
        $cod_categoria = filter_input(INPUT_POST, 'cod_categoria', FILTER_VALIDATE_INT);

        if (!$cod_categoria) {
            echo json_encode(["message" => "ID de categoria inválido.", "success" => false]);
            exit;
        }

        $sql = "UPDATE categoria SET categoria=?  WHERE cod_categoria=?";
        
        try {
            $stmt = $db->prepare($sql);
            $resultado = $stmt->execute([$categoria, $cod_categoria]);
            
            if ($resultado && $stmt->rowCount() > 0) {
                echo json_encode(["message" => "Categoria actualizado con éxito.", "success" => true]);
            } else {
                echo json_encode(["message" => "Error al actualizar la categoria o ningún dato cambió.", "success" => false]);
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