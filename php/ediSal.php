<?php
session_start();
include("./connection.php");

// Obtener datos del formulario
$id = mysqli_real_escape_string($conn, $_POST['id']);
$salaS = mysqli_real_escape_string($conn, $_POST['salaS']);
$nom = mysqli_real_escape_string($conn, $_POST['nom']);
$estado = mysqli_real_escape_string($conn, $_POST['estado']);

// Dividir la cadena en dos partes
$partes = explode(" ", $salaS);

// Guardar las partes en variables
$nombre = $partes[0];  // "terraza"
$numero = $partes[1];  // "1"

// Mapear el nombre a un valor numérico según tus condiciones
if ($nombre == 'Terraza') {
    $id_tipo_sala = 1;
} elseif ($nombre == 'Comedor') {
    $id_tipo_sala = 2;
} elseif ($nombre == 'Sala_privada') {
    $id_tipo_sala = 3;
}

// Preparar y ejecutar la consulta SQL
$stmt = mysqli_stmt_init($conn);
$sqlupdate = "UPDATE tbl_salas SET nombre_sala = ?, habilitado = ?, id_tipos_sala = ? WHERE id_sala = ?";
mysqli_stmt_prepare($stmt, $sqlupdate);
mysqli_stmt_bind_param($stmt, "siii", $numero, $estado, $id_tipo_sala, $id);
mysqli_stmt_execute($stmt);

// Manejar resultados y cerrar recursos
$_SESSION['crear'] = 'si';
mysqli_stmt_close($stmt);
mysqli_close($conn);

// Redirigir a la página principal
header('Location: ../php/homeAd.php');
exit();
?>
