<?php

$host = 'ec2-54-234-13-16.compute-1.amazonaws.com';
$dbname = 'd9rr9u5vu499vs';
$user = 'vgwynqajgpdtfd';
$password = 'd20645237ee210dd3993197bee4125f67a2e60c9deea3bd42c8f848d021dc809';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>

