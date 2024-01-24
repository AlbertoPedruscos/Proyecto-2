<?php
session_start();
include("./connection.php");

$id_mesa = $_POST['id_mesa'];
$nombre_mesa = $_POST['nombre_mesa'];
$sillas = $_POST['sillas'];
$id_estado_mesa = $_POST['id_estado_mesa'];
$id_sala_mesa = $_POST['id_sala_mesa'];

try {

    // Preparar la consulta de actualización
    $sqlupdate = "UPDATE tbl_mesas SET
                  nombre_mesa = :nombre_mesa,
                  sillas = :sillas,
                  id_estado_mesa = :id_estado_mesa,
                  id_sala_mesa = :id_sala_mesa
                  WHERE id_mesa = :id_mesa";

    $stmt = $conn->prepare($sqlupdate);

    // Vincular parámetros
    $stmt->bindParam(':nombre_mesa', $nombre_mesa, PDO::PARAM_STR);
    $stmt->bindParam(':sillas', $sillas, PDO::PARAM_INT);
    $stmt->bindParam(':id_estado_mesa', $id_estado_mesa, PDO::PARAM_INT);
    $stmt->bindParam(':id_sala_mesa', $id_sala_mesa, PDO::PARAM_INT);
    $stmt->bindParam(':id_mesa', $id_mesa, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    $_SESSION['crear'] = 'si';

    // Cerrar la conexión PDO
    $conn = null;

    header('Location: ../php/homeAd.php');
    exit();
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage() . "<br>";
    $_SESSION['crear'] = 'no';
    header('Location: ../php/homeAd.php');
    exit();
}
?>
