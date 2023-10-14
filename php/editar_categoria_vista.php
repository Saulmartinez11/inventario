<?php
include 'conexion.php';



$query = "SELECT * FROM categoria WHERE cod_categoria = :cod_categoria";
$stmt = $db->prepare($query);
$stmt->execute([':cod_categoria' => $cod_categoria]);

$categoria = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($categoria);
?>