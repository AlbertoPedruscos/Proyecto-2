<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit();
}

include './connection.php';

try {
    $rol = $_POST['rol'];
    
    $sqlUpdate = "UPDATE tbl_users SET rol = ? WHERE id_user = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindParam(1, $rol, PDO::PARAM_INT);
    $stmtUpdate->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
    $stmtUpdate->execute();

    $_SESSION['rol'] = $rol;

    if ($rol == 2) {
        header('Location: ../php/home.php');
        exit();
    } elseif ($rol == 3) {
        header('Location: ../php/homeMa.php');
        exit();
    }
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
?>
