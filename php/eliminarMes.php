<?php
include './connection.php';

// Recibe la variable enviada por AJAX
$id = mysqli_real_escape_string($conn, $_POST['idMes']);

$stmt = mysqli_stmt_init($conn);
$sqlDel =  "DELETE FROM tbl_mesas WHERE id_mesa = ?";
mysqli_stmt_prepare($stmt, $sqlDel);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>