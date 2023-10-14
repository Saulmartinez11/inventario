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

    if ($dbconn) {
        // Verificar si los datos fueron enviados por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recuperar datos del formulario
            $descripcion = $_POST['descripcion'];
            $id_empleado = $_POST['id_empleado'];
            $fecha_control_empleados = $_POST['datepicker'];

            // Validar que los campos no estén vacíos
            if (empty($descripcion) || empty($id_empleado) || empty($fecha_control_empleados)) {
                // Si algún campo está vacío, redirigir con un mensaje de error.
                header("Location: ../Añadir-control-empleados.html?error=" . urlencode("Error: Todos los campos son obligatorios"));
                exit;
            }

            // Verificar si el empleado existe en la tabla empleados_construccion
            $sqlVerificarEmpleado = "SELECT id_empleado FROM empleados_construccion WHERE id_empleado = :id_empleado";
            $stmtVerificarEmpleado = $dbconn->prepare($sqlVerificarEmpleado);
            $stmtVerificarEmpleado->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
            $stmtVerificarEmpleado->execute();

            if ($stmtVerificarEmpleado->rowCount() > 0) {
                // El empleado existe, proceder con la inserción
                $sqlControlEmpleados = "INSERT INTO listacontrolempleados(idempleado, fechacontrol_empleados, descripcion) VALUES(:id_empleado, :fecha_control_empleados, :descripcion)";
                $resultControlEmpleados = $dbconn->prepare($sqlControlEmpleados);
                $resultControlEmpleados->execute(array(':id_empleado' => $id_empleado, ':fecha_control_empleados' => $fecha_control_empleados, ':descripcion' => $descripcion));

                // Redirigir a la página Añadir-control-empleados.html con un parámetro de éxito
                header("Location: ../Añadir-control-empleados.html?success=true");
                exit;
            } else {
                // El empleado no existe, redirigir con un mensaje de error.
                header("Location: ../Añadir-control-empleados.html?error=" . urlencode("Error: El empleado no existe"));
                exit;
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
