<?php
session_start();
include './connection.php';

try {
    if (!isset($_POST['login'])) {
        header('Location: ../index.php');
        exit();
    } else {
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];

        // Preparar y ejecutar la consulta SQL
        $sql = "SELECT * FROM tbl_users WHERE user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $enc_pwd = $result['contra'];
            if (password_verify($pwd, $enc_pwd)) {
                $rol = $result['rol'];
                $_SESSION['id_user'] = $result['id_user'];
                $_SESSION['user'] = $user;
                $_SESSION['rol'] = $rol;
                
                // Redirigir según el rol del usuario
                if ($rol == '2') {
                    header('Location: ../php/home.php');
                    exit();
                } elseif ($rol == '3') {
                    header('Location: ../php/homeMa.php');
                    exit();
                } elseif ($rol == '1') {
                    header('Location: ../php/homeAd.php');
                    exit();
                }
            } else {
                header('Location: ../index.php?exist=0');
            }
        } else {
            header('Location: ../index.php?exist=0');
        }
    }
} catch (PDOException $e) {
    // Manejar errores de PDO
    echo "Error: " . $e->getMessage() . "<br>";
}

// Cerrar la conexión PDO
$conn = null;
?>
