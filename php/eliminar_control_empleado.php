<?php
include "conexion.php";

// Encabezado indicando que el contenido es JSON
header("Content-Type: application/json");
// Deshabilitar caché del lado del cliente
header("Cache-Control: no-cache, must-revalidate");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id_lista'])) {
        $id_lista = $_POST['id_lista'];
        
        try {
            // Verificar conexión a la base de datos
            if ($db instanceof PDO) {
                $sql = "DELETE FROM listacontrolempleados WHERE idlistacontrol = :id_lista";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id_lista', $id_lista, PDO::PARAM_INT);
                $stmt->execute();
                
                // Verificar si alguna fila fue afectada
                if ($stmt->rowCount() > 0) {
                    echo json_encode(["status" => "success"]);
                } else {
                    echo json_encode(["status" => "warning", "message" => "No rows affected"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Database connection error"]);
            }
        } catch(PDOException $e) {
            error_log($e->getMessage()); // Loggea el error
            echo json_encode(["status" => "error", "message" => "Database query error"]);
        }

        // Cerrar conexión 
        $db = null;

    } else {
        echo json_encode(["status" => "error", "message" => "No ID provided"]);
    }
}
?>
