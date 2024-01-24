<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = $_POST['idMes'];

try {
    // Preparar y ejecutar la consulta SQL
    $sqlDel = "DELETE FROM tbl_mesas WHERE id_mesa = ?";
    $stmt = $conn->prepare($sqlDel);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();

    // Cerrar la conexión PDO
    $conn = null;

} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage() . "<br>";
}

?>
