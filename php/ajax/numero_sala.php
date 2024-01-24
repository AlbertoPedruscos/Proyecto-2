<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user"])) {
    header('Location: ./cerrar.php');
    exit();
}

try {
    $tipo_sala = $_GET['tipo_sala'];

    $sql = "SELECT DISTINCT nombre_sala FROM tbl_tipos_salas tsa 
            INNER JOIN tbl_salas sa ON tsa.id_tipos = sa.id_tipos_sala 
            INNER JOIN tbl_mesas me ON sa.id_sala = me.id_sala_mesa 
            INNER JOIN tbl_estado esta ON me.id_estado_mesa = esta.id_estado
            WHERE nombre_tipos = ? ORDER BY id_sala ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $tipo_sala, PDO::PARAM_STR);
    $stmt->execute();

    // Valor seleccionado que se obtiene de $_GET['nombre_sala_seleccionada']
    $nombre_sala_seleccionada = isset($_GET['nombre_sala_seleccionada']) ? $_GET['nombre_sala_seleccionada'] : '';

    // Construye las opciones del segundo dropdown
    $options = '<option value="nu">Seleccione un número</option>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $num_sala = $row['nombre_sala'];
        $selected = ($num_sala == $nombre_sala_seleccionada) ? 'selected' : '';
        $options .= '<option value="' . $num_sala . '" ' . $selected . '>' . $num_sala . '</option>';
    }

    echo $options;
    
    $stmt = null; // Cierra la conexión PDO
    $conn = null; // Cierra la conexión PDO
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
?>
