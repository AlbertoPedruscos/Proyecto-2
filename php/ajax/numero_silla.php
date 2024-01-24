<?php
session_start();
include '../connection.php';

if (!isset($_SESSION["user"])) {
    header('Location: ./cerrar.php');
    exit();
}

try {
    $tipo_sala = $_GET['tipo_sala'];
    $sql = "SELECT DISTINCT sillas FROM tbl_tipos_salas tsa 
            INNER JOIN tbl_salas sa ON tsa.id_tipos = sa.id_tipos_sala 
            INNER JOIN tbl_mesas me ON sa.id_sala = me.id_sala_mesa 
            INNER JOIN tbl_estado esta ON me.id_estado_mesa = esta.id_estado
            WHERE nombre_tipos = ? ORDER BY sillas ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $tipo_sala, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Valor seleccionado que se obtiene de $_GET['num_sillas_seleccionadas']
    $num_sillas_seleccionadas = isset($_GET['num_sillas_seleccionadas']) ? $_GET['num_sillas_seleccionadas'] : '';

    // Construye las opciones del dropdown
    $options = '<option value="nu">Seleccione una mesa</option>';
    foreach ($result as $row) {
        $num_sillas = $row['sillas'];
        $selected = ($num_sillas == $num_sillas_seleccionadas) ? 'selected' : '';
        $options .= '<option value="' . $num_sillas . '" ' . $selected . '>' . $num_sillas . '</option>';
    }

    echo $options;

    // Cierra la conexión PDO
    $conn = null;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
?>
