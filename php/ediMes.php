<?php
session_start();
include("./connection.php");

$id_mesa = mysqli_real_escape_string($conn, $_POST['id_mesa']);
$nombre_mesa = mysqli_real_escape_string($conn, $_POST['nombre_mesa']);
$sillas = mysqli_real_escape_string($conn, $_POST['sillas']);
$id_estado_mesa = mysqli_real_escape_string($conn, $_POST['id_estado_mesa']);
$id_sala_mesa = mysqli_real_escape_string($conn, $_POST['id_sala_mesa']);

$stmt = mysqli_stmt_init($conn);
$sqlupdate = "UPDATE tbl_mesas SET
              nombre_mesa = ?,
              sillas = ?,
              id_estado_mesa = ?,
              id_sala_mesa = ?
              WHERE id_mesa = ?";

mysqli_stmt_prepare($stmt, $sqlupdate);
mysqli_stmt_bind_param($stmt, "siiii", $nombre_mesa, $sillas, $id_estado_mesa, $id_sala_mesa, $id_mesa);
mysqli_stmt_execute($stmt);

$_SESSION['actualizar'] = 'si';
mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: ../php/homeAd.php');
exit();
?>