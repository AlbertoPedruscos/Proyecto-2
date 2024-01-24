<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = $_POST['idSal'];

try {
    // Iniciar transacción PDO
    $conn->beginTransaction();

    // Preparar y ejecutar la primera consulta SQL
    $sqlDel1 = "DELETE FROM tbl_mesas WHERE id_sala_mesa = ?";
    $stmt1 = $conn->prepare($sqlDel1);
    $stmt1->bindParam(1, $id, PDO::PARAM_INT);
    $stmt1->execute();

    // Preparar y ejecutar la segunda consulta SQL
    $sqlDel2 = "DELETE FROM tbl_salas WHERE id_sala = ?";
    $stmt2 = $conn->prepare($sqlDel2);
    $stmt2->bindParam(1, $id, PDO::PARAM_INT);
    $stmt2->execute();

    // Confirmar la transacción PDO
    $conn->commit();

    // Cerrar la conexión PDO
    $conn = null;

} catch (PDOException $e) {
    // Manejar errores de PDO y realizar un rollback en caso de error
    echo "Error: " . $e->getMessage() . "<br>";
}

?>
