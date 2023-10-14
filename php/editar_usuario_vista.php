<?php
include 'conexion.php';

session_start();
$id_usuario = $_SESSION['id_usuario'];

$query = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
$stmt = $db->prepare($query);
$stmt->execute([':id_usuario' => $id_usuario]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($usuario);
?>
