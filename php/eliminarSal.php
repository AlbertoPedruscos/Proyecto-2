<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = mysqli_real_escape_string($conn, $_POST['idSal']);

$stmt = mysqli_stmt_init($conn);
$sqlDel =  "DELETE FROM tbl_mesas WHERE id_sala_mesa = ?";
mysqli_stmt_prepare($stmt, $sqlDel);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt2 = mysqli_stmt_init($conn);
$sqlDel2 =  "DELETE FROM tbl_salas WHERE id_sala = ?";
mysqli_stmt_prepare($stmt2, $sqlDel2);
mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);
mysqli_close($conn);
?>