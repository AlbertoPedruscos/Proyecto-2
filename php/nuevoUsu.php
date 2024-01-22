<?php
session_start();
include("./connection.php");

$nombre = mysqli_real_escape_string($conn, $_POST['usu']);
$numero = mysqli_real_escape_string($conn, $_POST['nom']);
$correo = mysqli_real_escape_string($conn, $_POST['sal']);
$direccion = mysqli_real_escape_string($conn, $_POST['tel']);
$rol = mysqli_real_escape_string($conn,$_POST['rol']);  // Assuming 'rol' is an integer

$stmt = mysqli_stmt_init($conn);

$sqlinsert = "INSERT INTO tbl_users (user, nombre, salario, telefono, rol) VALUES (?, ?, ?, ?, ?)";
mysqli_stmt_prepare($stmt, $sqlinsert);
mysqli_stmt_bind_param($stmt, "ssiii", $nombre, $numero, $correo, $direccion, $rol);
mysqli_stmt_execute($stmt);

$_SESSION['crear'] = 'si';

mysqli_stmt_close($stmt);
mysqli_close($conn);

header('Location: ../php/homeAd.php');
exit();
?>
