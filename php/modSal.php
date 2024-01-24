<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = $_POST['idSal'];

try {
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sqlDel = "UPDATE tbl_salas SET habilitado = 
            CASE 
                WHEN habilitado = 1 THEN 0 
                WHEN habilitado = 0 THEN 1 
            END 
            WHERE id_sala = ?";
    $stmt = $conn->prepare($sqlDel);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();

} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}
?>