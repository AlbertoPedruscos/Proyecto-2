<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = $_POST['idMes'];

try {
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sqlDel = "UPDATE tbl_mesas SET id_estado_mesa = 
            CASE 
                WHEN id_estado_mesa = 2 THEN 4 
                WHEN id_estado_mesa = 3 THEN 4 
                WHEN id_estado_mesa = 4 THEN 2 
            END 
            WHERE id_mesa = ?";
    $stmt = $conn->prepare($sqlDel);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();

} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
?>