<?php
session_start();
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

// Incluir tu archivo de conexión y cualquier lógica adicional necesaria
include './connection.php';

$selesala = "SELECT DISTINCT me.nombre_mesa, tisa.nombre_tipos ,sa.nombre_sala FROM tbl_historial hi
INNER JOIN tbl_mesas me ON me.id_mesa = hi.id_mesa
INNER JOIN tbl_salas sa ON sa.id_sala = hi.id_sala
INNER JOIN tbl_tipos_salas tisa ON tisa.id_tipos = sa.id_tipos_sala";
$stmt1 = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt1, $selesala);
mysqli_stmt_execute($stmt1);
$resultsala = mysqli_stmt_get_result($stmt1);

// Construir la tabla en el backend
$table = '<table cellspacing="0">';
$table .= '<thead><tr><th>Tipo de Sala</th><th>Mesa</th><th>Ocupaciones</th></tr></thead>';
$table .= '<tbody>';

if (mysqli_num_rows($resultsala) > 0) {
    foreach ($resultsala as $row) {
        $selecount = "SELECT me.nombre_mesa FROM tbl_historial hi
        INNER JOIN tbl_mesas me ON me.id_mesa = hi.id_mesa
        INNER JOIN tbl_salas sa ON sa.id_sala = hi.id_sala
        INNER JOIN tbl_tipos_salas tisa ON tisa.id_tipos = sa.id_tipos_sala WHERE hi.estado = 'Ocupado' AND me.nombre_mesa = ?";
        $stmt2 = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt2, $selecount);
        mysqli_stmt_bind_param($stmt2, "s", $row['nombre_mesa']);
        mysqli_stmt_execute($stmt2);
        $resultcount = mysqli_stmt_get_result($stmt2);
        $count = mysqli_num_rows($resultcount);
        $table .= '<tr>';
        $table .= '<td>' . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . '</td>';
        $table .= '<td>' . $row['nombre_mesa'] . '</td>';
        $table .= '<td>' . $count . '</td>';
        $table .= '</tr>';
        mysqli_stmt_close($stmt2);
    }
} else {
    $table .= '<tr><td colspan="3">No hay historico</td></tr>';
}

$table .= '</tbody></table>';

// Enviar la tabla al cliente
echo 'data: ' . json_encode(['table' => $table]) . "\n\n";

ob_flush();
flush();

mysqli_stmt_close($stmt1);
mysqli_close($conn);
?>
