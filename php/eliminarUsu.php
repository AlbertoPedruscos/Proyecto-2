<?php
include './connection.php';

$id = mysqli_real_escape_string($conn, $_POST['id']);

$stmt = mysqli_stmt_init($conn);
$sqlupdate = "UPDATE tbl_mesas SET id_camarero = NULL WHERE id_camarero = ?";
mysqli_stmt_prepare($stmt, $sqlupdate);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt2 = mysqli_stmt_init($conn);
$sqldelete = "DELETE FROM tbl_historial WHERE id_usuario = ?";
mysqli_stmt_prepare($stmt2, $sqldelete);
mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

$stmt3 = mysqli_stmt_init($conn);
$sqldelete2 = "DELETE FROM tbl_users WHERE id_user = ?";
mysqli_stmt_prepare($stmt3, $sqldelete2);
mysqli_stmt_bind_param($stmt3, "i", $id);
mysqli_stmt_execute($stmt3);
mysqli_stmt_close($stmt3);
mysqli_close($conn);

?>