<?php
    session_start();
    if ($_SESSION['rol']!=1){
        header('Location: ../index.php');
        exit();
    }
    include './connection.php';
    if(!isset($_SESSION['crear'])){
        $_SESSION['crear']='no';
    }
    if (!isset($_POST['rolP'])){
        $rolP='';
    }
    else{
        $rolP=$_POST['rolP'];
    }
    if (!isset($_POST['nombreP'])){
        $nombreP='';
    }
    else{
        $nombreP=$_POST['nombreP'];
    }
    if (!isset($_POST['tipo_sala'])){
        $tiSala='';
    }
    else{
        $tiSala=$_POST['tipo_sala'];
    }
    if (!isset($_POST['est'])){
        $est='';
    }
    else{
        $est=$_POST['est'];
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
        <label for="">Administrador</label>
        <button class="buN" onclick="usuarios()" id="usuariosBoton2">Modificar Usuarios</button>
        <button class="buN" onclick="salas()" id="salasBoton2">Modificar Salas</button>
        <button class="buN" onclick="mesas()" id="mesasBoton2">Modificar Mesas</button>
    </div>
    <div class="formula" id="ediUsu">
        <form action="../php/ediUsu.php" method="post" onsubmit="return validarFormulario2()">
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
                    // Consulta preparada con PDO
                    $opciones = "SELECT id_roles, nombre_rol FROM tbl_roles";
                    $stmt = $conn->prepare($opciones);

                    try {
                        $stmt->execute();

                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Iterar sobre los resultados y generar opciones HTML
                        foreach ($result as $row) {
                            echo "<option value=" . $row['id_roles'] . ">" . $row['nombre_rol'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta: " . $e->getMessage());
                    }
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
            <label for="">Contraseña</label>
            <br>
            <input type="text" id="pwd" name="pwd">
            <br>
            <br>
            <label for="">Rol</label>
            <br>
            <select id="rolU2" name="rol">
                <option value="">Escoja una opción</option>
                <?php
                    // Consulta preparada con PDO
                    $opciones = "SELECT id_roles, nombre_rol FROM tbl_roles";
                    $stmt = $conn->prepare($opciones);

                    try {
                        $stmt->execute();

                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Iterar sobre los resultados y generar opciones HTML
                        foreach ($result as $row) {
                            echo "<option value=" . $row['id_roles'] . ">" . $row['nombre_rol'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta: " . $e->getMessage());
                    }
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
                // Consulta preparada con PDO
                $opciones = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos 
                            FROM tbl_salas 
                            INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                $stmt = $conn->prepare($opciones);

                try {
                    $stmt->execute();

                    // Obtener los resultados como un array asociativo
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Iterar sobre los resultados y generar opciones HTML
                    foreach ($result as $row) {
                        echo "<option value=" . $row['id_sala'] . ">" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</option>";
                    }

                } catch (PDOException $e) {
                    die("Error en la consulta: " . $e->getMessage());
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
                    // Consulta preparada con PDO
                    $opciones = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = $conn->prepare($opciones);

                    try {
                        $stmt->execute();

                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Iterar sobre los resultados y generar opciones HTML
                        foreach ($result as $row) {
                            echo "<option value=" . $row['id_estado'] . ">" . $row['estado_nombre'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta: " . $e->getMessage());
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
                    // Consulta preparada con PDO
                    $opciones = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos 
                                FROM tbl_salas 
                                INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                    $stmt = $conn->prepare($opciones);

                    try {
                        $stmt->execute();

                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Iterar sobre los resultados y generar opciones HTML
                        foreach ($result as $row) {
                            echo "<option value=" . $row['id_sala'] . ">" . $row['nombre_tipos'] . ' ' . $row['nombre_sala'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta: " . $e->getMessage());
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
                    // Consulta preparada con PDO
                    $opciones = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = $conn->prepare($opciones);

                    try {
                        $stmt->execute();

                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Iterar sobre los resultados y generar opciones HTML
                        foreach ($result as $row) {
                            echo "<option value=" . $row['id_estado'] . ">" . $row['estado_nombre'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta: " . $e->getMessage());
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
            <form action="../php/homeAd.php" method="post">
                <select name="rolP" id="rolP">
                    <option value="">escoge rol</option>
                    <?php
                        // Consulta preparada con PDO
                        $consultaRoles = "SELECT id_roles, nombre_rol FROM tbl_roles";
                        $stmtRoles = $conn->query($consultaRoles);

                        try {
                            // Obtener los resultados como un array asociativo
                            $resultRoles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);

                            // Iterar sobre los resultados y generar opciones HTML
                            foreach ($resultRoles as $filaRol) {
                                $idRol = $filaRol['id_roles'];
                                $nombreRol = $filaRol['nombre_rol'];
                                echo "<option value='$idRol'>$nombreRol</option>";
                            }

                        } catch (PDOException $e) {
                            die("Error en la consulta de roles: " . $e->getMessage());
                        }
                    ?>
                </select>
                <input type="search" name="nombreP" id="nombreP">
                <button type="submit" class="envio">Buscar</button>
                <button type="button" onclick="mostrarUsu()" class="gold">Añadir Usuario</button>
            </form>
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
            if ($rolP=='' and $nombreP==''){
                $mostrar2 = "SELECT tbl_users.id_user, tbl_users.user, tbl_users.nombre, tbl_users.salario, tbl_users.telefono, tbl_roles.nombre_rol, tbl_roles.id_roles 
                            FROM tbl_users 
                            INNER JOIN tbl_roles ON tbl_users.rol = tbl_roles.id_roles 
                            WHERE id_roles != 1";
                
                // Preparar la sentencia
                $stmt27 = $conn->prepare($mostrar2);
                
                try {
                    // Ejecutar la sentencia
                    $stmt27->execute();
                
                    // Obtener los resultados como un array asociativo
                    $result27 = $stmt27->fetchAll(PDO::FETCH_ASSOC);
                
                    // Iterar sobre los resultados y mostrar cada fila en la tabla
                    foreach ($result27 as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['user']  . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['salario'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['nombre_rol'] . "</td>";
                        echo "<td><button class='boton3' onclick='eliminarUsu(" . $fila['id_user'] . ")'>Eliminar</button></td>";
                        echo "<td><button class='boton1' onclick='editarUsu(" . $fila['id_user'] . ", \"" . $fila['user'] . "\", \"" . $fila['nombre'] . "\", \"" . $fila['salario'] . "\", \"" . $fila['telefono'] . "\", \"" . $fila['id_roles'] . "\")'>Editar</button></td>";
                        // Puedes continuar aquí con las otras columnas
                        echo "</tr>";
                    }
                
                } catch (PDOException $e) {
                    die("Error en la consulta de usuarios: " . $e->getMessage());
                } finally {
                    // Cerrar la sentencia
                    $stmt27 = null;
                }                
            }  
            elseif ($rolP=='' and $nombreP!=''){
                $nombreP = '%' . $nombreP . '%';
                $mostrar2 = "SELECT tbl_users.id_user, tbl_users.user, tbl_users.nombre, tbl_users.salario, tbl_users.telefono, tbl_roles.nombre_rol, tbl_roles.id_roles 
                            FROM tbl_users 
                            INNER JOIN tbl_roles ON tbl_users.rol = tbl_roles.id_roles 
                            WHERE id_roles != 1 AND user LIKE :nombreP";

                // Preparar la sentencia
                $stmt27 = $conn->prepare($mostrar2);
                $stmt27->bindParam(':nombreP', $nombreP, PDO::PARAM_STR);

                try {
                    // Ejecutar la sentencia
                    $stmt27->execute();

                    // Obtener los resultados como un array asociativo
                    $result27 = $stmt27->fetchAll(PDO::FETCH_ASSOC);

                    // Iterar sobre los resultados y mostrar cada fila en la tabla
                    foreach ($result27 as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['user']  . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['salario'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['nombre_rol'] . "</td>";
                        echo "<td><button class='boton3' onclick='eliminarUsu(" . $fila['id_user'] . ")'>Eliminar</button></td>";
                        echo "<td><button class='boton1' onclick='editarUsu(" . $fila['id_user'] . ", \"" . $fila['user'] . "\", \"" . $fila['nombre'] . "\", \"" . $fila['salario'] . "\", \"" . $fila['telefono'] . "\", \"" . $fila['id_roles'] . "\")'>Editar</button></td>";
                        // Puedes continuar aquí con las otras columnas
                        echo "</tr>";
                    }

                } catch (PDOException $e) {
                    die("Error en la consulta de usuarios: " . $e->getMessage());
                } finally {
                    // Cerrar la sentencia
                    $stmt27 = null;
                }
            }
            elseif ($rolP!='' and $nombreP!=''){
                $nombreP = '%' . $nombreP . '%';
                $mostrar2 = "SELECT tbl_users.id_user, tbl_users.user, tbl_users.nombre, tbl_users.salario, tbl_users.telefono, tbl_roles.nombre_rol, tbl_roles.id_roles 
                            FROM tbl_users 
                            INNER JOIN tbl_roles ON tbl_users.rol = tbl_roles.id_roles 
                            WHERE id_roles != 1 AND rol = :rolP AND user LIKE :nombreP";
                
                // Preparar la sentencia
                $stmt27 = $conn->prepare($mostrar2);
                $stmt27->bindParam(':rolP', $rolP, PDO::PARAM_INT);
                $stmt27->bindParam(':nombreP', $nombreP, PDO::PARAM_STR);
                
                try {
                    // Ejecutar la sentencia
                    $stmt27->execute();
                
                    // Obtener los resultados como un array asociativo
                    $result27 = $stmt27->fetchAll(PDO::FETCH_ASSOC);
                
                    // Iterar sobre los resultados y mostrar cada fila en la tabla
                    foreach ($result27 as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['user']  . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['salario'] . "</td>";
                        echo "<td>" . $fila['telefono'] . "</td>";
                        echo "<td>" . $fila['nombre_rol'] . "</td>";
                        echo "<td><button class='boton3' onclick='eliminarUsu(" . $fila['id_user'] . ")'>Eliminar</button></td>";
                        echo "<td><button class='boton1' onclick='editarUsu(" . $fila['id_user'] . ", \"" . $fila['user'] . "\", \"" . $fila['nombre'] . "\", \"" . $fila['salario'] . "\", \"" . $fila['telefono'] . "\", \"" . $fila['id_roles'] . "\")'>Editar</button></td>";
                        // Puedes continuar aquí con las otras columnas
                        echo "</tr>";
                    }
                
                } catch (PDOException $e) {
                    die("Error en la consulta de usuarios: " . $e->getMessage());
                } finally {
                    // Cerrar la sentencia
                    $stmt27 = null;
                }
            }
            ?>
        </tbody>
    </table>
    </div>
    <div class="tab" id="mes2">
        <div class="fil">
            <form action="../php/homeAd.php" method="post">
            <label for="">Estado:</label>
                <select name="est" id="est">
                    <option value="">selecciona</option>
                    <?php
                    $mostrar = "SELECT id_estado, estado_nombre FROM tbl_estado";
                    $stmt = $conn->query($mostrar);

                    try {
                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                            $tabla = $row['nombre_tipos'] . " " . $row['nombre_sala'];
                            echo "<option value='" . $row['id_estado'] . "'>" . $row['estado_nombre'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta de estados: " . $e->getMessage());
                    } finally {
                        // Cerrar la sentencia
                        $stmt = null;
                    }
                    ?>
                </select>
                <button type="submit" class="envio">Buscar</button>
                <button type="button" onclick="mostrarMes()" class="gold">Añadir Sala</button>
            </form>
       </div>
        <table>
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Sala</th>
                    <th>Sillas</th>
                    <th>Estado</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
            <?php  
            if ($est == '') {
                $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_mesas.id_estado_mesa, tbl_salas.id_sala, tbl_salas.nombre_sala
                            FROM tbl_mesas
                            INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                            INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                            INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
                $stmt20 = $conn->query($mostrar);
            
                try {
                    // Obtener los resultados como un array asociativo
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
                        echo "<td><button class='boton3' onclick='eliminarMes(" . $row['id_mesa'] . ")'>Eliminar</button></td>";
                        echo "<td><button class='boton1' onclick='editarMes(" . $row['id_mesa'] . ", \"" . $row['nombre_mesa'] . "\", " . $row['sillas'] . ", " . $row['id_estado_mesa'] . ", " . $row['id_sala'] . ")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    die("Error en la consulta de mesas: " . $e->getMessage());
                } finally {
                    // Cerrar la sentencia
                    $stmt20 = null;
                }
            } else {
                $mostrar = "SELECT tbl_mesas.id_mesa, tbl_mesas.nombre_mesa, tbl_mesas.sillas, tbl_estado.estado_nombre, tbl_mesas.id_estado_mesa, tbl_salas.id_sala, tbl_salas.nombre_sala
                            FROM tbl_mesas
                            INNER JOIN tbl_estado ON tbl_mesas.id_estado_mesa = tbl_estado.id_estado
                            INNER JOIN tbl_salas ON tbl_mesas.id_sala_mesa = tbl_salas.id_sala
                            INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos WHERE id_estado_mesa = :est";
                $stmt20 = $conn->prepare($mostrar);
                $stmt20->bindParam(':est', $est, PDO::PARAM_INT);
            
                try {
                    // Ejecutar la sentencia
                    $stmt20->execute();
            
                    // Obtener los resultados como un array asociativo
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
                        echo "<td><button class='boton3' onclick='eliminarMes(" . $row['id_mesa'] . ")'>Eliminar</button></td>";
                        echo "<td><button class='boton1' onclick='editarMes(" . $row['id_mesa'] . ", \"" . $row['nombre_mesa'] . "\", " . $row['sillas'] . ", " . $row['id_estado_mesa'] . ", " . $row['id_sala'] . ")'>Editar</button></td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    die("Error en la consulta de mesas: " . $e->getMessage());
                } finally {
                    // Cerrar la sentencia
                    $stmt20 = null;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <div id="sal2" class="tab">
    <div class="fil">
        <form action="" method="post">
            <label for="">Tipos sala:</label>
            <select name="tipo_sala" id="id_sala2">
                <option value="">selecciona</option>
                <?php
                    $mostrar = "SELECT id_tipos, nombre_tipos FROM tbl_tipos_salas";
                    $stmt = $conn->query($mostrar);

                    try {
                        // Obtener los resultados como un array asociativo
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $row) {
                            echo "<option value='" . $row['id_tipos'] . "'>" . $row['nombre_tipos'] . "</option>";
                        }

                    } catch (PDOException $e) {
                        die("Error en la consulta de tipos de salas: " . $e->getMessage());
                    } finally {
                        // Cerrar la sentencia
                        $stmt = null;
                    }
                    ?>
            </select>
            <button type="submit" class="envio">Buscar</button>
            <button type="button" onclick="mostrarSal()" class="gold">Añadir Sala</button>
        </form>
    </div>
    <table>
    <thead>
        <tr>
            <th>Sala</th>
            <th>Aforo</th>
            <th>Estado</th>
            <th>Eliminar</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($tiSala == '') {
            $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos";
            $stmt27 = $conn->query($mostrar2);

            try {
                // Obtener los resultados como un array asociativo
                $result27 = $stmt27->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result27 as $row) {
                    $vamos2 = $row['nombre_tipos'] . ' ' . $row['nombre_sala'];
                    echo "<tr>";
                    echo "<td>" . $vamos2 . "</td>";
                    echo "<td>" . $row['aforo'] . "</td>";
                    echo "<td>" . ($row['habilitado'] == 1 ? 'Habilitada' : 'Deshabilitada') . "</td>";
                    echo "<td><button class='boton3' onclick='eliminarSal(" . $row['id_sala'] . ")'>Eliminar</button></td>";
                    echo "<td><button class='boton1' onclick='editarSal(" . $row['id_sala'] . ", \"" . $vamos2 . "\", " . $row['habilitado'] . ")'>Editar</button></td>";
                    echo "</tr>";
                }

            } catch (PDOException $e) {
                die("Error en la consulta de salas: " . $e->getMessage());
            } finally {
                // Cerrar la sentencia
                $stmt27 = null;
            }
        } else {
            $mostrar2 = "SELECT tbl_salas.id_sala, tbl_salas.nombre_sala, tbl_tipos_salas.nombre_tipos, tbl_tipos_salas.aforo, tbl_salas.habilitado FROM tbl_salas INNER JOIN tbl_tipos_salas ON tbl_salas.id_tipos_sala = tbl_tipos_salas.id_tipos WHERE tbl_salas.id_tipos_sala = :tiSala";
            $stmt27 = $conn->prepare($mostrar2);
            $stmt27->bindParam(':tiSala', $tiSala, PDO::PARAM_INT);

            try {
                // Ejecutar la sentencia
                $stmt27->execute();

                // Obtener los resultados como un array asociativo
                $result27 = $stmt27->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result27 as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['nombreTipos'] . ' ' . $row['nombreSala'] . "</td>";
                    echo "<td>" . $row['aforo'] . "</td>";
                    $vamos2 = $row['nombreTipos'] . ' ' . $row['nombreSala'];
                    echo "<td>" . ($row['habilitado'] == 1 ? 'Habilitada' : 'Deshabilitada') . "</td>";
                    echo "<td><button class='boton3' onclick='eliminarSal(" . $row['id_sala'] . ")'>Eliminar</button></td>";
                    echo "<td><button class='boton1' onclick='editarSal(" . $row['id_sala'] . ", \"" . $vamos2 . "\", " . $row['habilitado'] . ")'>Editar</button></td>";
                    echo "</tr>";
                }

            } catch (PDOException $e) {
                die("Error en la consulta de salas: " . $e->getMessage());
            } finally {
                // Cerrar la sentencia
                $stmt27 = null;
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
if ($_SESSION['crear']=='si'){
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
$_SESSION['crear']='no';
?>