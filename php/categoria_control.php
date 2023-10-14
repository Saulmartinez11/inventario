<?php
// Conexión a la base de datos
$host = "ec2-54-234-13-16.compute-1.amazonaws.com";
$port = "5432";
$dbname = "d9rr9u5vu499vs";
$user = "vgwynqajgpdtfd";
$password = "d20645237ee210dd3993197bee4125f67a2e60c9deea3bd42c8f848d021dc809";
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    $conn = new PDO($dsn);
    
    // Si deseas mantener el mensaje para propósitos de depuración, puedes escribirlo en el log de errores en lugar de enviarlo como output.
    error_log("Conectado a la base de datos {$dbname} con éxito."); 
} catch (PDOException $e) {
    echo $e->getMessage();
}



// Recibir datos del formulario
$categoria = $_POST['categoria'];

// Validaciones
$camposObligatorios = [$categoria];
foreach ($camposObligatorios as $campo) {
    if(empty($campo)) {
        http_response_code(400); // Bad Request
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }
}

// SQL para insertar datos
$sql = "INSERT INTO categoria 
        (categoria) 
        VALUES 
        (:categoria)";

$query = $conn->prepare($sql);

$query->bindParam(':categoria', $categoria, PDO::PARAM_STR);

try {
    $query->execute();
    http_response_code(200); // Asegurándonos de que estamos enviando un 200 OK
    echo json_encode(["success" => true, "message" => "Categoria añadido con éxito."]);
} catch (PDOException $e) {
    http_response_code(500); // Enviar un 500 Error
    echo json_encode(["success" => false, "message" => "Error al añadir Categoria."]);
} finally {
    $conn = null; // Siempre cerrar la conexión, incluso si hay un error.
}
exit();

?>