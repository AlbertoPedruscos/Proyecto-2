<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user"])) {
    header('Location: ./cerrar.php');
    exit();
}

// Asegúrate de que el parámetro 'id' está definido
if (isset($_GET['id_mesa'])) {
    $idMesa = htmlspecialchars($_GET['id_mesa']);
    $sala = htmlspecialchars($_GET['sala']);
    $num_sala = htmlspecialchars($_GET['num_sala']);
    $mesa = htmlspecialchars($_GET['mesa']);
    $estadoget = htmlspecialchars($_GET['estado']);
    if (isset($_GET['hora_reserva'])) {
        $hora = htmlspecialchars($_GET['hora_reserva']);
    }

    try {
        $conn->beginTransaction();

        // Consulta para obtener el estado actual de la mesa
        $sqlSelect = "SELECT me.id_sala_mesa, me.id_camarero, es.estado_nombre as estado_mesa FROM tbl_mesas me INNER JOIN tbl_estado es ON me.id_estado_mesa = es.id_estado WHERE me.id_mesa = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bindParam(1, $idMesa, PDO::PARAM_INT);
        $stmtSelect->execute();
        $selectRow = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        // Insertar en la tabla de historial
        if ($selectRow['estado_mesa'] == "Ocupado") {
            $estado = "Libre";
        } elseif ($selectRow['estado_mesa'] == "Libre" && isset($_GET['hora_reserva'])) {
            $estado = "Reservado";
        } else {
            $estado = "Ocupado";
        }

        $sqlInsertHistorial = "INSERT INTO tbl_historial (id_usuario, id_mesa, id_sala, estado) VALUES (?, ?, ?, ?)";
        $stmtInsertHistorial = $conn->prepare($sqlInsertHistorial);
        $stmtInsertHistorial->bindParam(1, $_SESSION['id_user'], PDO::PARAM_INT);
        $stmtInsertHistorial->bindParam(2, $idMesa, PDO::PARAM_INT);
        $stmtInsertHistorial->bindParam(3, $selectRow['id_sala_mesa'], PDO::PARAM_INT);
        $stmtInsertHistorial->bindParam(4, $estado, PDO::PARAM_STR);
        $stmtInsertHistorial->execute();

        // Verifica el estado actual de la mesa
        if ($selectRow['estado_mesa'] == "Ocupado") {
            // Actualizar el estado y la fecha de salida en la base de datos
            $sqlLibre = "UPDATE tbl_mesas SET id_estado_mesa = (SELECT id_estado FROM tbl_estado WHERE estado_nombre = 'Libre'), id_camarero = NULL WHERE id_mesa = ?";
            $stmtLibre = $conn->prepare($sqlLibre);
            $stmtLibre->bindParam(1, $idMesa, PDO::PARAM_INT);
            $stmtLibre->execute();
        } elseif ($selectRow['estado_mesa'] == "Libre" && $_GET['hora_reserva']!='') {
            // Actualizar el estado, la fecha de entrada y asignar el id_camarero en la base de datos
            $sqlReser = "UPDATE tbl_mesas SET id_estado_mesa = (SELECT id_estado FROM tbl_estado WHERE estado_nombre = 'Reservado'), id_camarero = ?, hora = ? WHERE id_mesa = ?";
            $stmtReser = $conn->prepare($sqlReser);
            $stmtReser->bindParam(1, $_SESSION['id_user'], PDO::PARAM_INT);
            $stmtReser->bindParam(2, $hora, PDO::PARAM_STR);
            $stmtReser->bindParam(3, $idMesa, PDO::PARAM_INT);
            $stmtReser->execute();
        } else {
            // Actualizar el estado, la fecha de entrada y asignar el id_camarero en la base de datos
            $sqlOcupa = "UPDATE tbl_mesas SET id_estado_mesa = (SELECT id_estado FROM tbl_estado WHERE estado_nombre = 'Ocupado'), id_camarero = ? WHERE id_mesa = ?";
            $stmtOcupa = $conn->prepare($sqlOcupa);
            $stmtOcupa->bindParam(1, $_SESSION['id_user'], PDO::PARAM_INT);
            $stmtOcupa->bindParam(2, $idMesa, PDO::PARAM_INT);
            $stmtOcupa->execute();
        }

        // Commit de la transacción
        $conn->commit();
        header("Location: ../home.php?sala=$sala&num_sala=$num_sala&mesa=$mesa&estado=$estadoget");
    } catch (Exception $e) {
        // En caso de error, realizar un rollback
        echo "Error: " . $e->getMessage() . "<br>";
        $conn->rollBack();
    }
} else {
    // Manejar el caso en el que 'id' no está definido o no es un número entero
    echo "Error: El parámetro 'id' no está definido o no es un número entero.";
}

// Cerrar la conexión a la base de datos
$stmtSelect = null;
$stmtInsertHistorial = null;
$stmtLibre = null;
$stmtOcupa = null;
$conn = null;
?>