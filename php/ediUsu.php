<?php
session_start();
include("./connection.php");

$id = mysqli_real_escape_string($conn,$nombre=$_POST['id']);
$nombre = mysqli_real_escape_string($conn,$nombre=$_POST['usu']);
$numero = mysqli_real_escape_string($conn,$_POST['nom']);
$correo = mysqli_real_escape_string($conn,$_POST['sal']);
$direccion = mysqli_real_escape_string($conn,$_POST['tel']);
$rol = mysqli_real_escape_string($conn,$_POST['rol']);

$stmt = mysqli_stmt_init($conn);
$sqlinsert =  "UPDATE tbl_users SET user = ?, nombre = ?, salario = ?, telefono = ?, rol = ? WHERE id_user=?";
mysqli_stmt_prepare($stmt, $sqlinsert);
mysqli_stmt_bind_param($stmt, "ssiiii", $nombre, $numero, $correo, $direccion, $rol, $id);
mysqli_stmt_execute($stmt);
$_SESSION['crear']='si';
mysqli_stmt_close($stmt);
mysqli_close($conn);
header('Location: ../php/homeAd.php');
exit();
?>