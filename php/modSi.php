<?php
session_start();
include './connection.php';

// Recibe las variables enviadas por AJAX
$idMesa = $_POST['silo'];
$nuevasSillas = $_POST['sillass'];

try {
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sqlUpdate = "UPDATE tbl_mesas SET sillas = ? WHERE id_mesa = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bindParam(1, $nuevasSillas, PDO::PARAM_INT);
    $stmt->bindParam(2, $idMesa, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['crear'] = 'si';
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}
// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
header('Location: ../php/homeMa.php');
exit();
?>
