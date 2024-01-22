<?php
session_start();
include("./connection.php");

$nombre_mesa = mysqli_real_escape_string($conn, $_POST['nombre_mesa']);
$sillas = mysqli_real_escape_string($conn, $_POST['sillas']);
$id_estado_mesa = mysqli_real_escape_string($conn, $_POST['id_estado_mesa']);
$id_sala_mesa = mysqli_real_escape_string($conn, $_POST['id_sala_mesa']);

$stmt = mysqli_stmt_init($conn);
$sqlinsert = "INSERT INTO tbl_mesas (nombre_mesa, sillas, id_estado_mesa, id_sala_mesa) VALUES (?, ?, ?, ?)";

mysqli_stmt_prepare($stmt, $sqlinsert);
mysqli_stmt_bind_param($stmt, "siii", $nombre_mesa, $sillas, $id_estado_mesa, $id_sala_mesa);
mysqli_stmt_execute($stmt);

$_SESSION['actualizar'] = 'si';
mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: ../php/homeAd.php');
exit();
?>