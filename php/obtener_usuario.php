<?php
// es_administrador.php
include "conexion.php";

header("Content-Type: application/json");
header("Cache-Control: no-cache, must-revalidate");

session_start(); // Asegurarse de que la sesión ha sido iniciada

// Implementa tu propia lógica para verificar si el usuario actual es administrador.
// Por ejemplo, puede que necesites verificar alguna variable de sesión que hayas establecido durante el inicio de sesión.
$esAdministrador = $_SESSION['cargo'] === 'administrador'; // Un ejemplo, adaptar según tu implementación

echo json_encode(["esAdministrador" => $esAdministrador]);
?>
