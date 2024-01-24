<?php
session_start();
include './connection.php';

if ($_SESSION['rol'] != 3) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['crear'])) {
    $_SESSION['crear'] = 'no';
}

if (!isset($_POST['tipo_sala'])) {
    $tiSala = '';
} else {
    $tiSala = $_POST['tipo_sala'];
}

if (!isset($_POST['est'])) {
    $est = '';
} else {
    $est = $_POST['est'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="../css/styleMa3.css">
</head>

<body>
    <div class="nav">
        <label for="">Mantenimiento</label>
        <button onclick="mesas2()" class="buN" id="mesasBoton">Mesas</button>
        <button onclick="salas2()" class="buN" id="salasBoton">Salas</button>
    </div>

    <div class="formula" id="silles">
        <form action="../php/modSi.php" method="post" onsubmit="return validarFormulario()">
            <input type="text" id="silo" name="silo">
            <label for="">Sillas</label>
            <br>
            <input type="number" id="sillass" name="sillass">
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar2()">Volver</button>
        </form>
    </div>

    <div class="tab" id="mes">
        <br>
        <br>
        <br>
        <div class="fil">
            <form action="../php/homeMa.php" method="post">
                <label for="">Estado:</label>
                <select name="est" id="est">
                    <option value="">selecciona</option>
                    <?php
                    $mostrar = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = $conn->prepare($mostrar);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        echo "<option value='" . $row['id_estado'] . "'>" . $row['estado_nombre'] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="envio">Buscar</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Sala</th>
                    <th>Sillas</th>
                    <th>Estado</th>
                    <th>Deshabilitar/habilitar</th>
                    <th>Modificar Sillas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($est == '') {
                    $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_salas.id_sala, tbl_salas.nombre_sala
                    FROM tbl_mesas
                    INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                    INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                    INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos
                    WHERE tbl_mesas.id_estado_mesa != 1";

                    $stmt20 = $conn->prepare($mostrar);
                    $stmt20->execute();
                    $result = $stmt20->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_mesa'] . "</td>";

                        $primera_letra = strtoupper(substr($row['nombre_mesa'], 0, 1));
                        if ($primera_letra == 'T') {
                            $tabla = "Terraza " . $row['nombre_sala'];
                        } elseif ($primera_letra == 'C') {
                            $tabla = "Comedor " . $row['nombre_sala'];
                        } elseif ($primera_letra == 'S') {
                            $tabla = "Sala Privada " . $row['nombre_sala'];
                        }

                        echo "<td>" . $tabla . "</td>";
                        echo "<td>" . $row['sillas'] . "</td>";
                        echo "<td>" . $row['estado_nombre'] . "</td>";
                        echo "<td><button class='boton1' onclick='modMes(" . $row['id_mesa'] . ")'>Modificar Estado</button></td>";
                        echo "<td><button class='boton2' data-id-mesa='" . $row['id_mesa'] . "' data-sillas='" . $row['sillas'] . "' onclick='modSi(" . $row['id_mesa'] . ", " . $row['sillas'] . ")'>Modificar Sillas</button></td>";
                    }
                } elseif ($est != '') {
                    $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_salas.id_sala, tbl_salas.nombre_sala
                    FROM tbl_mesas
                    INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                    INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                    INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos
                    WHERE tbl_mesas.id_estado_mesa != 1 AND tbl_mesas.id_estado_mesa = ?";

                    $stmt = $conn->prepare($mostrar);
                    $stmt->bindParam(1, $est, PDO::PARAM_INT);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_mesa'] . "</td>";

                        $primera_letra = strtoupper(substr($row['nombre_mesa'], 0, 1));
                        if ($primera_letra == 'T') {
                            $tabla = "Terraza " . $row['nombre_sala'];
                        } elseif ($primera_letra == 'C') {
                            $tabla = "Comedor " . $row['nombre_sala'];
                        } elseif ($primera_letra == 'S') {
                            $tabla = "Sala Privada " . $row['nombre_sala'];
                        }

                        echo "<td>" . $tabla . "</td>";
                        echo "<td>" . $row['sillas'] . "</td>";
                        echo "<td>" . $row['estado_nombre'] . "</td>";
                        echo "<td><button class='boton1' onclick='modMes(" . $row['id_mesa'] . ")'>Modificar Estado</button></td>";
                        echo "<td><button class='boton2' data-id-mesa='" . $row['id_mesa'] . "' data-sillas='" . $row['sillas'] . "' onclick='modSi(" . $row['id_mesa'] . ", " . $row['sillas'] . ")'>Modificar Sillas</button></td>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div id="sal" class="tab">
        <br>
        <br>
        <br>
        <div class="fil">
            <form action="../php/homeMa.php" method="post">
                <label for="">Tipos sala:</label>
                <select name="tipo_sala" id="id_sala2">
                    <option value="">selecciona</option>
                    <?php
                    $mostrar = "SELECT id_tipos, nombre_tipos FROM tbl_tipos_salas";
                    $stmt = $conn->prepare($mostrar);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<option value='" . $row['id_tipos'] . "'>" . $row['nombre_tipos'] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" class="envio">Buscar</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Aforo</th>
                    <th>Habilitado</th>
                    <th>Deshabilitar/habilitar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($tiSala == '') {
                    $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";

                    $stmt27 = $conn->prepare($mostrar2);
                    $stmt27->execute();
                    $result = $stmt27->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</td>";
                        echo "<td>" . $row['aforo'] . "</td>";

                        if ($row['habilitado'] == 1) {
                            echo "<td>Habilitado</td>";
                        } else {
                            echo "<td>Deshabilitado</td>";
                        }

                        echo "<td><button class='boton1' onclick='modSal(" . $row['id_sala'] . ")'>Modificar Estado</button></td>";
                        echo "</tr>";
                    }
                } elseif ($tiSala != '') {
                    $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos WHERE tbl_salas.id_tipos_sala = ?";

                    $stmt27 = $conn->prepare($mostrar2);
                    $stmt27->bindParam(1, $tiSala, PDO::PARAM_INT);
                    $stmt27->execute();
                    $result = $stmt27->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</td>";
                        echo "<td>" . $row['aforo'] . "</td>";

                        if ($row['habilitado'] == 1) {
                            echo "<td>Habilitado</td>";
                        } else {
                            echo "<td>Deshabilitado</td>";
                        }

                        echo "<td><button class='boton1' onclick='modSal(" . $row['id_sala'] . ")'>Modificar Estado</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/JsMa99.js"></script>

<?php
if ($_SESSION['crear'] == 'si') {
    echo "<script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            timer: 2000,
            showConfirmButton: false,
            width: '300px',
            customClass: {
                popup: 'custom-popup-class'
            }
        });
    </script>";
}
$_SESSION['crear'] = 'no';
$conn = null;
?>