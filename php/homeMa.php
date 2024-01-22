<?php
    session_start();
    include './connection.php';
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
        <button onclick="mesas2()" class="buN">Mesas</button>
        <button onclick="salas2()" class="buN">Salas</button>
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
            <form action="" method="post">
                <label for="">Nombre sala:</label>
                <select name="id_sala" id="id_sala">
                    <option value="">selecciona</option>
                    <?php
                    $mostrar = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $mostrar);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tabla = $row['nombre_tipos'] . " " . $row['nombre_sala'];
                        echo "<option value='" . $row['id_sala'] . "'>" . $tabla . "</option>";
                    }
                    mysqli_stmt_close($stmt);
                    ?>
                </select>
                <label for="">Tipos sala:</label>
                <select name="" id="">
                    <option value="">selecciona</option>
                </select>
                <label for="">Sillas:</label>
                <select name="" id="">
                    <option value="">selecciona</option>
                </select>
                <label for="">Estado:</label>
                <select name="" id="">
                    <option value="">selecciona</option>
                    <?php
                    $mostrar = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $mostrar);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $tabla = $row['nombre_tipos'] . " " . $row['nombre_sala'];
                        echo "<option value='" . $row['id_estado'] . "'>" . $row['estado_nombre'] . "</option>";
                    }
                    mysqli_stmt_close($stmt);
                    ?>
                </select>
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
                $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_salas.id_sala, tbl_salas.nombre_sala
                FROM tbl_mesas
                INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos
                WHERE tbl_mesas.id_estado_mesa != 1";
                $stmt20 = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt20, $mostrar);
                mysqli_stmt_execute($stmt20);
                $result = mysqli_stmt_get_result($stmt20);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombre_mesa'] . "</td>";
                    $primera_letra = strtoupper(substr($row['nombre_mesa'], 0, 1));
                    if ($primera_letra == 'T') {
                        $tabla = "Terraza " . $row['nombre_sala'];
                    } 
                    elseif ($primera_letra == 'C') {
                        $tabla = "Comedor " . $row['nombre_sala'];                    
                    }
                    elseif ($primera_letra == 'S') {
                        $tabla = "Sala Privada " . $row['nombre_sala'];                    
                    }
                    echo "<td>" . $tabla . "</td>";
                    echo "<td>" . $row['sillas'] . "</td>";
                    echo "<td>" . $row['estado_nombre'] . "</td>";
                    echo "<td><button class='boton1' onclick='modMes(" . $row['id_mesa']/*  . $row['estado_nombre'] */ .")'>Modificar Estado</button></td>";
                    echo "<td><button class='boton2' data-id-mesa='" . $row['id_mesa'] . "' data-sillas='" . $row['sillas'] . "' onclick='modSi(" . $row['id_mesa'] . ", " . $row['sillas'] . ")'>Modificar Sillas</button></td>";
                }
                mysqli_stmt_close($stmt20);
            ?>
            </tbody>
        </table>
    </div>
    <div id="sal" class="tab">
    <br>
    <br>
    <br>
    <div class="fil">
    <form action="" method="post">
        <label for="">Nombre sala:</label>
        <select name="id_sala" id="id_sala2">
            <option value="">selecciona</option>
            <?php
                $mostrar = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt, $mostrar);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['id_sala'] . "'>" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</option>";
                }
                mysqli_stmt_close($stmt);
            ?>
        </select>
        <label for="">Tipos sala:</label>
        <select name="tipo_sala" id="tipo_sala2">
            <option value="">selecciona</option>
        </select>
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


        $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
        $stmt27 = mysqli_prepare($conn, $mostrar2);
        mysqli_stmt_execute($stmt27);
        mysqli_stmt_bind_result($stmt27, $id_sal, $nombreSala, $nombreTipos, $aforo, $habil);
        while (mysqli_stmt_fetch($stmt27)) {
            echo "<tr>";
            echo "<td>" . $nombreTipos  . $nombreSala . "</td>";
            echo "<td>" . $aforo . "</td>";
            if ($habil==1){
                echo "<td>Habiltado</td>";
            }
            else{
                echo "<td>Deshabiltado</td>";
            }
            echo "<td><button class='boton1' onclick='modSal(" . $id_sal . ")'>Modificar Estado</button></td>";
            echo "</tr>";
        }
        mysqli_stmt_close($stmt27);
        mysqli_close($conn);
        ?>
    </tbody>
</table>
</div>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/JsMa77.js"></script>