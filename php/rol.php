<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit();
}
include './connection.php';
$rol = mysqli_real_escape_string($conn, $_POST['rol']);
$sql2 = "UPDATE tbl_users SET rol = ? WHERE id_user = ?";
$stmtSelect = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmtSelect, "ii", $rol, $_SESSION['id_user']);
mysqli_stmt_execute($stmtSelect);
if ($rol==2){
    header('Location: ../php/home.php');
    exit();
}
elseif($rol==3){
    header('Location: ../php/homeCh.php');
    exit();
}
elseif($rol==4){
    header('Location: ../php/homeMa.php');
    exit();
}
