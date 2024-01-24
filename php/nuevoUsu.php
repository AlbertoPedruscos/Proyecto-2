<?php
session_start();
include("./connection.php");

$nombre = $_POST['usu'];
$numero = $_POST['nom'];
$correo = $_POST['sal'];
$direccion = $_POST['tel'];
$rol = $_POST['rol'];
$contra = $_POST['pwd'];
$hashedPwd = password_hash($contra, PASSWORD_BCRYPT);

try {
    // Preparar y ejecutar la consulta SQL con la conexión existente
    $sql = "SELECT * FROM tbl_users WHERE user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) > 0) {
        header('Location: ../php/homeAd.php');
        exit();
    } else {
        $sqlinsert = "INSERT INTO tbl_users (user, nombre, contra, salario, telefono, rol) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlinsert);
        $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmt->bindParam(2, $numero, PDO::PARAM_STR);
        $stmt->bindParam(3, $hashedPwd, PDO::PARAM_STR);
        $stmt->bindParam(4, $correo, PDO::PARAM_STR);
        $stmt->bindParam(5, $direccion, PDO::PARAM_STR);
        $stmt->bindParam(6, $rol, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['crear'] = 'si';
    }
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
header('Location: ../php/homeAd.php');
exit();
?>
