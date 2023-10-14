<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();  
header('Content-Type: application/json');
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
 
// Verificación de la sesión y permisos del usuario
if (!isset($_SESSION['cargo']) || $_SESSION['cargo'] != 'administrador') {
    echo json_encode(["success" => false, "message" => "No tienes permisos para realizar esta acción."]);
    exit;
}
 

// Recibir datos del formulario
$primer_nombre1 = $_POST['primer_nombre1'];
$segundo_nombre1 = $_POST['segundo_nombre1'];
$primer_apellido1 = $_POST['primer_apellido1'];
$segundo_apellido1 = $_POST['segundo_apellido1'];
$edad1 = $_POST['edad1'];
$nombre_usuario1 = $_POST['nombre_usuario1'];
$cargo1 = $_POST['cargo1'];
$contraseña1 = $_POST['contraseña1']; 

// Hashear la contraseña
$contraseña_hashed = password_hash($contraseña1, PASSWORD_DEFAULT);

// Validaciones
$camposObligatorios = [$primer_nombre1, $primer_apellido1, $edad1, $nombre_usuario1, $cargo1, $contraseña1];
foreach ($camposObligatorios as $campo) {
    if(empty($campo)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
        exit();
    }
}

if(!is_numeric($edad1)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "La edad debe ser un número."]);
    exit();
}

// SQL para insertar datos
$sql = "INSERT INTO usuarios 
        (primer_nombre, segundo_nombre, primer_apellido, 
         segundo_apellido, edad, nombre_usuario, cargo, contraseña) 
        VALUES 
        (:primer_nombre, :segundo_nombre, :primer_apellido, 
         :segundo_apellido, :edad, :nombre_usuario, :cargo, :contrasena)";

$query = $conn->prepare($sql);

$query->bindParam(':primer_nombre', $primer_nombre1, PDO::PARAM_STR);
$query->bindParam(':segundo_nombre', $segundo_nombre1, PDO::PARAM_STR);
$query->bindParam(':primer_apellido', $primer_apellido1, PDO::PARAM_STR);
$query->bindParam(':segundo_apellido', $segundo_apellido1, PDO::PARAM_STR);
$query->bindParam(':edad', $edad1, PDO::PARAM_INT);
$query->bindParam(':nombre_usuario', $nombre_usuario1, PDO::PARAM_STR);
$query->bindParam(':cargo', $cargo1, PDO::PARAM_STR);
$query->bindParam(':contrasena', $contraseña_hashed, PDO::PARAM_STR);

try {
    $query->execute();
    $response = ["success" => true, "message" => "Usuario añadido con éxito."];
    http_response_code(200);
} catch (PDOException $e) {
    error_log($e->getMessage()); // Loguea el error, no lo expongas
    $response = ["success" => false, "message" => "Error al añadir usuario."];
    http_response_code(500);
} finally {
    $conn = null;
    // Un único punto de salida para tu respuesta.
    echo json_encode($response);
}
exit();
?>
