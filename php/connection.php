<?php

$dbserver = "localhost";
$dbuser = "root";
$dbpwd = "";
$dbbasedatos = "db_restaurante";

try {
    // Crear una instancia de PDO
    $conn = new PDO("mysql:host=$dbserver;dbname=$dbbasedatos", $dbuser, $dbpwd);

    // Establecer el modo de error para lanzar excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Redirigir a una página de error en caso de fallo
    header('Location: ../fallo.html');
    exit();
}
?>
