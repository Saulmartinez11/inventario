<?php
$host = "ec2-54-234-13-16.compute-1.amazonaws.com";
$port = "5432";
$dbname = "d9rr9u5vu499vs";
$user = "vgwynqajgpdtfd";
$password = "d20645237ee210dd3993197bee4125f67a2e60c9deea3bd42c8f848d021dc809";

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    // Crear una conexión a la base de datos PostgreSQL
    $dbconn = new PDO($dsn);

    // Verificar si los datos fueron enviados por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recuperar datos del formulario
        $descripcion = $_POST['descripcion'];
        $tipo_categoria = $_POST['tipo_categoria'];
        $producto = $_POST['producto'];
        $fecha_control = $_POST['datepicker'];
        $cantidad = $_POST['cantidad'];

        // Verificar si los campos numéricos son válidos
        if (!is_numeric($cantidad) || !is_numeric($tipo_categoria)) {
            // Si no es un número, redirigir con un mensaje de error.
            header("Location: ../Añadir-control.html?error=" . urlencode("Error: Campos inválidos tipo o cantidad"));
            exit;
        }

        // Crear una sentencia SQL INSERT para lista_control
        $sqlControl = "INSERT INTO lista_control(tipo, producto, descripcion, fechacontrol, cantidad) VALUES(:tipo, :producto, :descripcion, :fechacontrol, :cantidad)";
        $resultControl = $dbconn->prepare($sqlControl);
        $resultControl->execute(array(':tipo' => $tipo_categoria, ':producto' => $producto, ':descripcion' => $descripcion, ':fechacontrol' => $fecha_control, ':cantidad' => $cantidad));

        // Crear una sentencia SQL INSERT para productos, con lógica de actualización si el producto ya existe
        $sqlProducto = "INSERT INTO productos(codcategoria, nombre_producto, cantidad) VALUES(:codcategoria, :nombre_producto, :cantidad) 
                        ON CONFLICT(nombre_producto) 
                        DO UPDATE SET cantidad = productos.cantidad + EXCLUDED.cantidad";

        $resultProducto = $dbconn->prepare($sqlProducto);
        $resultProducto->execute(array(':codcategoria' => $tipo_categoria, ':nombre_producto' => $producto, ':cantidad' => $cantidad));

        if (!$resultControl || !$resultProducto) {
            // Hubo un error al añadir datos, redirigir a la página Añadir-control.html con un mensaje de error
            header("Location: ../Añadir-control.html?error=" . urlencode("Error al añadir datos"));
            exit;
        }

        // Redirigir a la página Añadir-control.html con un parámetro de éxito
        header("Location: ../Añadir-control.html?success=true");
        exit;
    }
} catch (PDOException $e) {
    // Redirigir a la página Añadir-control.html con un mensaje de error
    header("Location: ../Añadir-control.html?error=" . urlencode("Error al añadir datos: " . $e->getMessage()));
    exit;
}
?>
