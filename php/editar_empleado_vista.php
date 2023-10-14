<?php
include 'conexion.php';



$query = "SELECT * FROM empleados_construccion WHERE id_empleado = :id_empleado";
$stmt = $db->prepare($query);
$stmt->execute([':id_empleado' => $id_empleado]);

$empleados_construccion = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($empleados_construccion);
?>