<?php
if (isset($_SESSION["user"])) {
    header('Location: ./home.php');
    exit();
}
include './connection.php';
try {
    if (!isset($_POST['registro'])) {
        header('Location: ../registro.php');
    } else {
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $tel = mysqli_real_escape_string($conn, $_POST['telefono']);
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

        $sql = "SELECT * FROM tbl_users WHERE user = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            header('Location: ../registro.php?exist=0');
        } else {
            // Use password_hash to securely hash the password
            $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
            if ($user=='' or strlen($user)>20){
                header('Location: ../registro.php?exist=0');
                exit;
            }
            if ($nombre=='' or strlen($nombre)>60){
                header('Location: ../registro.php?exist=0');
                exit;
            }
            if (strlen($tel)!=9){
                header('Location: ../registro.php?exist=0');
                exit;
            }            
            $sql2 = "INSERT INTO tbl_users (user, nombre, contra, telefono) VALUES (?, ?, ?, ?)";
            $stmtSelect = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmtSelect, "ssss", $user, $nombre, $hashedPwd, $tel);
            mysqli_stmt_execute($stmtSelect);
            $_SESSION['id_user'] = $login['id_user'];
            $_SESSION['user'] = $user;
            header('Location: ../php/home.php');

        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
