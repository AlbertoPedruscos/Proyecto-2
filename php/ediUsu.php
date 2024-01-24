<?php
session_start();
include("./connection.php");

$id = $_POST['id'];
$nombre = $_POST['usu'];
$numero = $_POST['nom'];
$correo = $_POST['sal'];
$direccion = $_POST['tel'];
$rol = $_POST['rol'];

try {
        // Actualizar los datos del usuario
        $sqlUpdateUser = "UPDATE tbl_users SET user = ?, nombre = ?, salario = ?, telefono = ?, rol = ? WHERE id_user=?";
        $stmtUpdateUser = $conn->prepare($sqlUpdateUser);
        $stmtUpdateUser->bindParam(1, $nombre, PDO::PARAM_STR);
        $stmtUpdateUser->bindParam(2, $numero, PDO::PARAM_STR);
        $stmtUpdateUser->bindParam(3, $correo, PDO::PARAM_INT);
        $stmtUpdateUser->bindParam(4, $direccion, PDO::PARAM_STR);
        $stmtUpdateUser->bindParam(5, $rol, PDO::PARAM_INT);
        $stmtUpdateUser->bindParam(6, $id, PDO::PARAM_INT);
        $stmtUpdateUser->execute();

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
