<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = mysqli_real_escape_string($conn, $_POST['idSal']);

$stmt = mysqli_stmt_init($conn);
$sqlDel = "UPDATE tbl_salas SET habilitado = 
            CASE 
                WHEN habilitado = 1 THEN 0 
                WHEN habilitado = 0 THEN 1 
            END 
            WHERE id_sala = ?";
mysqli_stmt_prepare($stmt, $sqlDel);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
