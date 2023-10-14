<?php
session_start();

include 'conexion.php';

if (isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = :nombre_usuario");
        $stmt->bindParam(':nombre_usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            // Si la contraseña del usuario no parece estar hasheada (puedes ajustar la condición según sea necesario)
            if (strlen($user['contraseña']) < 60) {
                if ($password === $user['contraseña']) {
                    // Si la contraseña es correcta, hasheamos y actualizamos la contraseña en la DB
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    $updateStmt = $db->prepare("UPDATE usuarios SET contraseña = :password WHERE nombre_usuario = :nombre_usuario");
                    $updateStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                    $updateStmt->bindParam(':nombre_usuario', $usuario, PDO::PARAM_STR);
                    $updateStmt->execute();

                    $_SESSION['usuario'] = $user['nombre_usuario'];
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['cargo'] = $user['cargo'];
                    header('Location: ../Inicio.html');
                    exit;
                } else {
                    $error = "Contraseña incorrecta.";
                    header('Location: ../index.html?error=1');
                    exit;
                }
            } else {
                // Si la contraseña ya está hasheada, verificamos con password_verify
                if (password_verify($password, $user['contraseña'])) {
                    $_SESSION['usuario'] = $user['nombre_usuario'];
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['cargo'] = $user['cargo'];
                    header('Location: ../Inicio.html');
                    exit;
                } else {
                    $error = "Contraseña incorrecta.";
                    header('Location: ../index.html?error=1');
                    exit;
                }
            }
        } else {
            $error = "Usuario no encontrado.";
            header('Location: ../index.html?error=2');
            exit;
        }
    } catch (PDOException $e) {
        $error = "Error de base de datos: " . $e->getMessage();
        header('Location: ../index.html?error=3');
        exit;
    }
}

if (!empty($error)) {
    $_SESSION['error'] = $error;
}
?>
