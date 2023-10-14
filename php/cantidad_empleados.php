<?php
header("Access-Control-Allow-Origin: *");

include "conexion.php";

try {
    $sql = "SELECT COUNT(*) AS total_empleados FROM empleados_construccion";
    $resultado = $db->query($sql);

    if ($resultado) {
        $fila = $resultado->fetch(PDO::FETCH_ASSOC);
        echo $fila['total_empleados']; // Nota el cambio aquí.
    } else {
        echo "Error en la consulta SQL.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
