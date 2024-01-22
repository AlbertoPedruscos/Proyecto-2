<?php
include './connection.php';

// Recibe las variables enviadas por AJAX
$idMesa = mysqli_real_escape_string($conn, $_POST['silo']);
$nuevasSillas = mysqli_real_escape_string($conn, $_POST['sillass']);

$stmt = mysqli_stmt_init($conn);
$sqlUpdate = "UPDATE tbl_mesas 
              SET  sillas = ?
              WHERE id_mesa = ?";
mysqli_stmt_prepare($stmt, $sqlUpdate);
mysqli_stmt_bind_param($stmt, "ii", $nuevasSillas, $idMesa);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
header('Location: ../php/homeMa.php');
exit();
?>
