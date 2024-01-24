<?php
session_start();
include './connection.php';

try {
    if (!isset($_POST['registro'])) {
        header('Location: ../registro.php');
        exit();
    } else {
        $user = $_POST['user'];
        $tel = $_POST['telefono'];
        $nombre = $_POST['nombre'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * FROM tbl_users WHERE user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) > 0) {
            header('Location: ../registro.php?exist=0');
            exit();
        } else {
            // Use password_hash to securely hash the password
            $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

            if (empty($user) || strlen($user) > 20 || empty($nombre) || strlen($nombre) > 60 || strlen($tel) != 9) {
                header('Location: ../registro.php?exist=0');
                exit();
            }

            $sql2 = "INSERT INTO tbl_users (user, nombre, contra, telefono) VALUES (?, ?, ?, ?)";
            $stmtSelect = $conn->prepare($sql2);
            $stmtSelect->bindParam(1, $user, PDO::PARAM_STR);
            $stmtSelect->bindParam(2, $nombre, PDO::PARAM_STR);
            $stmtSelect->bindParam(3, $hashedPwd, PDO::PARAM_STR);
            $stmtSelect->bindParam(4, $tel, PDO::PARAM_STR);
            $stmtSelect->execute();
            $lastInsertId = $conn->lastInsertId();
            $_SESSION['id_user'] = $lastInsertId;
            $_SESSION['user'] = $user;
            header('Location: ../php/escogerRol.php');
            exit();
        }
    }
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage();
}

// No es necesario cerrar la conexión PDO aquí, ya que la conexión es mantenida por el script connection.php
?>
