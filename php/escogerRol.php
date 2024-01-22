<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="../css/roles.css">
</head>
<body>
    <div class="circulo">
        <form action="rol.php" method="post">
            <h1>Escoja su especialidad</h1>
            <br>
            <br>
            <button value="2" name="rol" class="btn-moderno2">Camarero</button>
            <button value="3" name="rol" class="btn-moderno3">Mantenimiento</button>
        </form>
        <br>
    </div>
</body>
</html>