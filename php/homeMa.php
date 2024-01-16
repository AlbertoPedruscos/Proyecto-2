<?php
    include './connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <style>
        body{
            margin: 0px;
            font-family: 'Poppins', sans-serif;
            background-color: orangered;
            background-image: url(../images/fondo.jpg);
            background-size: cover;
        }
        /* Estilo básico para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Estilo para las celdas del encabezado */
        th {
            color: white;
            background-color: pink;
        }

        /* Estilo para todas las celdas */
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        /* Cambia el color de fondo de las filas alternas (opcional) */
        tr {
            background-color: orange;
            color: white;
        }

        /* Hover sobre las filas (opcional) */
        tr:hover {
            background-color: yellow;
        }
        .nav{
            padding: 10px;
            padding-left: 30px;
            font-size: 30px;
            height: 40px;
            width: 110%;
            position: fixed;
            background-image: url(../images/madera.jpg);
            background-color: brown;
            color: white;
        }
        .buN{
            cursor: pointer;
            padding-left: 30px;
            font-size: 20px;
            background-color: transparent;
            color: white;
            border: none;
        }
        select{
            cursor: pointer;
        }
        .tab{
            background-color: brown;
            border-bottom: solid white;
        }
        #sal{
            display: none;
        }
        #mes{
            display: none;
        }
    </style>
</head>
<body>
    <div class="nav">
        <label for="">Mantenimiento</label>
        <button onclick="mesas()" class="buN">Mesas</button>
        <button onclick="salas()" class="buN">Salas</button>
    </div>
    <div class="tab" id="mes">
        <br>
        <br>
        <br>
        <br>
        <form action="" method="post">
            <label for="">Nombre sala</label>
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
            <label for="">Tipos sala</label>
            <select name="" id="">
                <option value="">selecciona</option>
            </select>
            <label for="">Sillas</label>
            <select name="" id="">
                <option value="">selecciona</option>
            </select>
            <label for="">Estado</label>
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
        <br>
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
                $mostrar = "SELECT tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_salas.id_sala, tbl_salas.nombre_sala
                FROM tbl_mesas
                INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
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
                    echo "<td><button>Modificar Estado</button></td>";
                    echo "<td><button>Modificar Sillas</button></td>";
                }
                mysqli_stmt_close($stmt20);
                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>

    <div id="sal" class="tab">
    <br>
    <br>
    <br>
    <br>
    <form action="" method="post">
        <label for="">Nombre sala</label>
        <select name="id_sala" id="id_sala">
            <option value="">selecciona</option>
            <?php

            ?>
        </select>
        <label for="">Tipos sala</label>
        <select name="tipo_sala" id="tipo_sala">
            <option value="">selecciona</option>
        </select>
    </form>
    <br>
        <table>
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Tipos</th>
                    <th>Aforo</th>
                    <th>Estado</th>
                    <th>Deshabilitar/habilitar</th>
                    <th>Modificar Sillas</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $mostrar2 ="SELECT tbl_sala.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
  
            ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<script>
    var mes = document.getElementById('mes');
    var sal = document.getElementById('sal');
    function mesas(){
       mes.style.display="block"; 
       sal.style.display="none"; 
    }
    function salas(){
       mes.style.display="none"; 
       sal.style.display="block"; 
    }
</script>