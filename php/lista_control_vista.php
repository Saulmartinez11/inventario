<?php

$host = 'ec2-54-234-13-16.compute-1.amazonaws.com';
$dbname = 'd9rr9u5vu499vs';
$user = 'vgwynqajgpdtfd';
$password = 'd20645237ee210dd3993197bee4125f67a2e60c9deea3bd42c8f848d021dc809';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    $query = "SELECT id_lista, tipo, producto, descripcion, fechacontrol, cantidad FROM lista_control ORDER BY id_lista ASC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $lista_control = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($lista_control);
    } else {
        echo json_encode(["error" => "No se encontraron registros en lista_control"]);
    }
} catch (PDOException $e) {
    // Log error message
    error_log($e->getMessage());
    // Show a generic message to the user
    echo json_encode(["error" => "No se pudo realizar la operación. Inténtalo de nuevo más tarde."]);
}

// Esto cierra la conexión en PDO.
$db = null;  
?>
