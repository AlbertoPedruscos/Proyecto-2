<?php
include './connection.php';

$id = $_POST['id'];

try {
    // Crear una instancia de PDO
    $conn = new PDO("mysql:host=$dbserver;dbname=$dbbasedatos", $dbuser, $dbpwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Iniciar transacción PDO
    $conn->beginTransaction();

    // Preparar y ejecutar la primera consulta SQL
    $sqlupdate = "UPDATE tbl_mesas SET id_camarero = NULL WHERE id_camarero = ?";
    $stmt1 = $conn->prepare($sqlupdate);
    $stmt1->bindParam(1, $id, PDO::PARAM_INT);
    $stmt1->execute();

    // Preparar y ejecutar la segunda consulta SQL
    $sqldelete = "DELETE FROM tbl_historial WHERE id_usuario = ?";
    $stmt2 = $conn->prepare($sqldelete);
    $stmt2->bindParam(1, $id, PDO::PARAM_INT);
    $stmt2->execute();

    // Preparar y ejecutar la tercera consulta SQL
    $sqldelete2 = "DELETE FROM tbl_users WHERE id_user = ?";
    $stmt3 = $conn->prepare($sqldelete2);
    $stmt3->bindParam(1, $id, PDO::PARAM_INT);
    $stmt3->execute();

    // Confirmar la transacción PDO
    $conn->commit();

    // Cerrar la conexión PDO
    $conn = null;

} catch (PDOException $e) {
    // Manejar errores de PDO y realizar un rollback en caso de error
    echo "Error: " . $e->getMessage() . "<br>";
}
?>
