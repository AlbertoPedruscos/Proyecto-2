<?php
session_start();
include("./connection.php");

// Obtener datos del formulario
$id = $_POST['id'];
$salaS = $_POST['salaS'];
$nom = $_POST['nom'];
$estado = $_POST['estado'];

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

try {
    // Preparar y ejecutar la consulta SQL
    $sqlupdate = "UPDATE tbl_salas SET nombre_sala = ?, habilitado = ?, id_tipos_sala = ? WHERE id_sala = ?";
    $stmt = $conn->prepare($sqlupdate);
    $stmt->bindParam(1, $numero, PDO::PARAM_STR);
    $stmt->bindParam(2, $estado, PDO::PARAM_INT);
    $stmt->bindParam(3, $id_tipo_sala, PDO::PARAM_INT);
    $stmt->bindParam(4, $id, PDO::PARAM_INT);
    $stmt->execute();

    // Manejar resultados
    $_SESSION['crear'] = 'si';

    // Cerrar la conexión PDO
    $conn = null;

    // Redirigir a la página principal
    header('Location: ../php/homeAd.php');
    exit();
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage() . "<br>";
    $_SESSION['crear'] = 'no';
    header('Location: ../php/homeAd.php');
    exit();
}
?>
