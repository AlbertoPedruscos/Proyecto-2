<?php
session_start();
include("./connection.php");

// Obtener datos del formulario
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
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sqlinsert = "INSERT INTO tbl_salas (nombre_sala, habilitado, id_tipos_sala) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sqlinsert);
    $stmt->bindParam(1, $numero, PDO::PARAM_STR);
    $stmt->bindParam(2, $estado, PDO::PARAM_INT);
    $stmt->bindParam(3, $id_tipo_sala, PDO::PARAM_INT);
    $stmt->execute();

    // Manejar resultados
    $_SESSION['crear'] = 'si';

} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
// Redirigir a la página principal
header('Location: ../php/homeAd.php');
exit();
?>
