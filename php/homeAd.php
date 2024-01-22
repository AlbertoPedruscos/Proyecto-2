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
        <label for="">Administrador</label>
        <button class="buN" onclick="usuarios()">Modificar Usuarios</button>
        <button class="buN" onclick="salas()">Modificar Salas</button>
        <button class="buN" onclick="mesas()">Modificar Mesas</button>
    </div>
    <div class="formula" id="ediUsu">
        <form action="../php/ediSal.php" method="post" onsubmit="return validarFormulario2()">
            <input type="text" id="idU" name="id">
            <label for="">User</label>
            <br>
            <input type="text" id="userU" name="usu">
            <br>
            <br>
            <label for="">Nombre</label>
            <br>
            <input type="text" id="nombreU" name="nom">
            <br>
            <br>
            <label for="">Salario</label>
            <br>
            <input type="text" id="salU" name="sal">
            <br>
            <br>
            <label for="">Telefono</label>
            <br>
            <input type="text" id="telU" name="tel">
            <br>
            <br>
            <label for="">Rol</label>
            <br>
            <select id="rolU" name="rol">
                <option value="">Escoja una opción</option>
                <?php
                    $opciones = "SELECT id_roles, nombre_rol FROM tbl_roles";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_roles'] . ">" . $row['nombre_rol'] . "</option>";
                    }
                    //mysqli_stmt_close($stmt);
                ?>
            </select>
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <div class="formula" id="nuevoUsu">
        <form action="../php/nuevoUsu.php" method="post" onsubmit="return validarFormulario3()">
            <label for="">User</label>
            <br>
            <input type="text" id="userU2" name="usu">
            <br>
            <br>
            <label for="">Nombre</label>
            <br>
            <input type="text" id="nombreU2" name="nom">
            <br>
            <br>
            <label for="">Salario</label>
            <br>
            <input type="text" id="salU2" name="sal">
            <br>
            <br>
            <label for="">Telefono</label>
            <br>
            <input type="text" id="telU2" name="tel">
            <br>
            <br>
            <label for="">Rol</label>
            <br>
            <select id="rolU2" name="rol">
                <option value="">Escoja una opción</option>
                <?php
                    $opciones = "SELECT id_roles, nombre_rol FROM tbl_roles";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_roles'] . ">" . $row['nombre_rol'] . "</option>";
                    }
                    //mysqli_stmt_close($stmt);
                ?>
            </select>
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <div class="formula" id="ediSalas">
        <form action="../php/ediSal.php" method="post" onsubmit="return validarFormulario4()">
            <input type="text" id="idS" name="id">
            <label for="">Sala</label>
            <br>
            <input type="text" id="salaS" name="salaS">       
            <br>
            <br>
            <label for="">Estado</label>
            <br>
            <select id="estadoS" name="estado">
                <option value="">Escoja una opción</option>
                <option value="0">Deshabilitada</option>
                <option value="1">Habilitada</option>
            </select>
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <div class="formula" id="nuevoSalas">
        <form action="../php/nuevoSal.php" method="post" onsubmit="return validarFormulario5()">
            <label for="">Sala</label>
            <br>
            <input type="text" id="salaS2" name="salaS">       
            <br>
            <br>
            <label for="">Estado</label>
            <br>
            <select id="estadoS2" name="estado">
                <option value="">Escoja una opción</option>
                <option value="0">Deshabilitada</option>
                <option value="1">Habilitada</option>
            </select>
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <div class="formula" id="nuevoMesas">
        <form action="../php/ediMes.php" method="post" onsubmit="return validarFormulario6()">
            <input type="text" id="id_mesa" name="id_mesa" required>
            <label for="">Mesa</label>
            <br>
            <input type="text" id="nombre_mesa" name="nombre_mesa">
            <br>
            <br>
            <label for="">Sala</label>
            <br>
            <select type="number" id="id_sala_mesa" name="id_sala_mesa">
                <option value="">escoge una opcion</option>
                <?php
                    $opciones = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos 
                    FROM tbl_salas 
                    INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_sala'] . ">" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="">Estado</label>
            <br>
            <select id="id_estado_mesa" name="id_estado_mesa">
                <option value="">escoge una opcion</option>
                <?php
                    $opciones = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_estado'] . ">" . $row['estado_nombre'] . "</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="">Sillas</label>
            <br>
            <input type="text" id="sillas" name="sillas">
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <div class="formula" id="nuevoMesas2">
        <form action="../php/nuevoMes.php" method="post" onsubmit="return validarFormulario7()">
            <label for="nombre_mesa2">Mesa:</label>
            <label for="">Mesa</label>
            <br>
            <input type="text" id="nombre_mesa2" name="nombre_mesa">
            <br>
            <br>
            <label for="">Sala</label>
            <br>
            <select type="number" id="id_sala_mesa2" name="id_sala_mesa">
                <option value="">escoge una opcion</option>
                <?php
                    $opciones = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos 
                    FROM tbl_salas 
                    INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_sala'] . ">" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="">Estado</label>
            <br>
            <select id="id_estado_mesa2" name="id_estado_mesa">
                <option value="">escoge una opcion</option>
                <?php
                    $opciones = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $opciones);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value=" . $row['id_estado'] . ">" . $row['estado_nombre'] . "</option>";
                    }
                ?>
            </select>
            <br>
            <br>
            <label for="">Sillas</label>
            <br>
            <input type="text" id="sillas2" name="sillas">
            <br>
            <br>
            <button type="submit" class="envio">Enviar</button>
            <button type="button" class="volver" onclick="ocultar()">Volver</button>
        </form>
    </div>
    <br>
    <br>
    <br>
    <div class="tab" id="usu">
        <div class="fil">
            <!-- <form action="" method="post"> -->
                <select name="" id="">
                    <option value="">escoge rol</option>
                </select>
                <input type="search">
                <button onclick="mostrarUsu()">Añadir Usuario</button>
            <!-- </form> -->
        </div>
    <table>
        <thead>
            <tr>
                <th>Sala</th>
                <th>Aforo</th>
                <th>Salario</th>
                <th>Teléfono</th>
                <th>Cargo</th>
                <th>Eliminar</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $mostrar2 = "SELECT tbl_users.id_user, tbl_users.user, tbl_users.nombre, tbl_users.salario, tbl_users.telefono, tbl_roles.nombre_rol, tbl_roles.id_roles FROM tbl_users INNER JOIN tbl_roles ON tbl_users.rol = tbl_roles.id_roles WHERE id_roles != 1";
    
            // Preparar la sentencia
            $stmt27 = mysqli_prepare($conn, $mostrar2);
            // Ejecutar la sentencia
            mysqli_stmt_execute($stmt27);
    
            // Vincular las variables de resultados
            mysqli_stmt_bind_result($stmt27, $idUser, $user, $nombre, $salario, $tele, $rol, $idRol);
    
            // Iterar sobre los resultados y mostrar cada fila en la tabla
            while (mysqli_stmt_fetch($stmt27)) {
                echo "<tr>";
                echo "<td>" . $user  . "</td>";
                echo "<td>" . $nombre . "</td>";
                echo "<td>" . $salario . "</td>";
                echo "<td>" . $tele . "</td>";
                echo "<td>" . $rol . "</td>";
                echo "<td><button class='boton3' onclick='eliminarUsu(" . $idUser . ")'>Eliminar</button></td>";
                echo "<td><button class='boton1' onclick='editarUsu(" . $idUser . ", \"" . $user . "\", \"" . $nombre . "\", \"" . $salario . "\", \"" . $tele . "\", \"" . $idRol . "\")'>Editar</button></td>";
                // Puedes continuar aquí con las otras columnas
                echo "</tr>";
            }
    
            // Cerrar la sentencia y la "conexión"
            mysqli_stmt_close($stmt27);
            ?>
        </tbody>
    </table>
    </div>
    <div class="tab" id="mes2">
        <div class="fil">
<!--             <form action="" method="post">
 -->                <label for="">Nombre sala:</label>
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
                <button onclick="mostrarMes()">Añadir Sala</button>
<!--             </form>
 -->        </div>
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
            $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_mesas.id_estado_mesa, tbl_salas.id_sala, tbl_salas.nombre_sala
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
                } elseif ($primera_letra == 'C') {
                    $tabla = "Comedor " . $row['nombre_sala'];
                } elseif ($primera_letra == 'S') {
                    $tabla = "Sala Privada " . $row['nombre_sala'];
                }

                echo "<td>" . $tabla . "</td>";
                echo "<td>" . $row['sillas'] . "</td>";
                echo "<td>" . $row['estado_nombre'] . "</td>";
                echo "<td><button class='boton3' onclick='eliminarMes(" . $row['id_mesa'] . ")'>Eliminar Mesa</button></td>";
                echo "<td><button class='boton1' onclick='editarMes(" . $row['id_mesa'] . ", \"" . $row['nombre_mesa'] . "\", " . $row['sillas'] . ", " . $row['id_estado_mesa'] . ", " . $row['id_sala'] . ")'>Editar Mesa</button></td>";
                echo "</tr>";
            }
            mysqli_stmt_close($stmt20);
            ?>
            </tbody>
        </table>
    </div>
    
    
    <div id="sal2" class="tab">
    <div class="fil">
<!--     <form action="" method="post"> -->
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
        <button onclick="mostrarSal()">Añadir Sala</button>
<!--     </form> -->
    </div>
    <table>
    <thead>
        <tr>
            <th>Sala</th>
            <th>Aforo</th>
            <th>Estado</th>
            <th>Deshabilitar/habilitar</th>
            <th>Modificar Sillas</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
        $stmt27 = mysqli_prepare($conn, $mostrar2);
        mysqli_stmt_execute($stmt27);
        mysqli_stmt_bind_result($stmt27, $idSal, $nombreSala, $nombreTipos, $aforo, $hab);
        while (mysqli_stmt_fetch($stmt27)) {
            echo "<tr>";
            echo "<td>" . $nombreTipos . ' ' . $nombreSala . "</td>";
            echo "<td>" . $aforo . "</td>";
            $vamos2 = $nombreTipos . ' ' . $nombreSala;
            if ($hab==1){
                echo "<td>Habilitada</td>";
            }else{
                echo "<td>Deshabilitada</td>";
            }
            echo "<td><button class='boton3' onclick='eliminarSal(" . $idSal . ")'>Eliminar Sala</button></td>";
            echo "<td><button class='boton1' onclick='editarSal(" . $idSal . ", \"" . $vamos2 . "\", " . $hab . ")'>Modificar Sala</button></td>";
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