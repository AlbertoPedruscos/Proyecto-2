<?php
session_start();
include("./connection.php");

$nombre_mesa = $_POST['nombre_mesa'];
$sillas = $_POST['sillas'];
$id_estado_mesa = $_POST['id_estado_mesa'];
$id_sala_mesa = $_POST['id_sala_mesa'];

try {
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sqlinsert = "INSERT INTO tbl_mesas (id_mesa, nombre_mesa, sillas, id_estado_mesa, id_sala_mesa) VALUES (NULL, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlinsert);
    $stmt->bindParam(1, $nombre_mesa, PDO::PARAM_STR);
    $stmt->bindParam(2, $sillas, PDO::PARAM_INT);
    $stmt->bindParam(3, $id_estado_mesa, PDO::PARAM_INT);
    $stmt->bindParam(4, $id_sala_mesa, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['crear'] = 'si';

} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
header('Location: ../php/homeAd.php');
exit();
?>