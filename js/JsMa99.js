var mes2 = document.getElementById('mes2');
var sal2 = document.getElementById('sal2');
var usu = document.getElementById('usu');
var mes = document.getElementById('mes');
var sal = document.getElementById('sal');
document.addEventListener('DOMContentLoaded', function() {
    // Recuperar el estado almacenado en localStorage
    var estadoActual = localStorage.getItem('estadoVisible');

    // Obtener referencias a los elementos
    var mes2 = document.getElementById('mes2');
    var sal2 = document.getElementById('sal2');
    var usu = document.getElementById('usu');

    // Establecer el estado inicial basado en el valor recuperado
    if (estadoActual === 'mesas') {
        mes2.style.display = 'block';
        sal2.style.display = 'none';
        usu.style.display = 'none';
    } else if (estadoActual === 'salas') {
        mes2.style.display = 'none';
        sal2.style.display = 'block';
        usu.style.display = 'none';
    } else if (estadoActual === 'usuarios') {
        mes2.style.display = 'none';
        sal2.style.display = 'none';
        usu.style.display = 'block';
    } else {
        // Si no hay un estado almacenado, establecer un estado predeterminado
        mes2.style.display = 'block';
        sal2.style.display = 'none';
        usu.style.display = 'none';
    }

    // Agregar eventos de clic a los botones
    var mesasBoton = document.getElementById('mesasBoton2');
    mesasBoton.addEventListener('click', function() {
        mes2.style.display = 'block';
        sal2.style.display = 'none';
        usu.style.display = 'none';
        // Almacenar el estado en localStorage
        localStorage.setItem('estadoVisible', 'mesas');
    });

    var salasBoton = document.getElementById('salasBoton2');
    salasBoton.addEventListener('click', function() {
        mes2.style.display = 'none';
        sal2.style.display = 'block';
        usu.style.display = 'none';
        // Almacenar el estado en localStorage
        localStorage.setItem('estadoVisible', 'salas');
    });

    var usuariosBoton = document.getElementById('usuariosBoton2');
    usuariosBoton.addEventListener('click', function() {
        mes2.style.display = 'none';
        sal2.style.display = 'none';
        usu.style.display = 'block';
        // Almacenar el estado en localStorage
        localStorage.setItem('estadoVisible', 'usuarios');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Recuperar el estado almacenado en localStorage
    var estadoActual = localStorage.getItem('estadoVisible');

    // Obtener referencias a los elementos
    var mes = document.getElementById('mes');
    var sal = document.getElementById('sal');

    // Establecer el estado inicial basado en el valor recuperado
    if (estadoActual === 'mes') {
        mes.style.display = 'block';
        sal.style.display = 'none';
    } else if (estadoActual === 'sal') {
        mes.style.display = 'none';
        sal.style.display = 'block';
    } else {
        // Si no hay un estado almacenado, establecer un estado predeterminado
        mes.style.display = 'block';
        sal.style.display = 'none';
    }

    // Agregar eventos de clic a los botones
    var mesasBoton = document.getElementById('mesasBoton');
    mesasBoton.addEventListener('click', function() {
        mes.style.display = 'block';
        sal.style.display = 'none';
        // Almacenar el estado en localStorage
        localStorage.setItem('estadoVisible', 'mes');
    });

    var salasBoton = document.getElementById('salasBoton');
    salasBoton.addEventListener('click', function() {
        mes.style.display = 'none';
        sal.style.display = 'block';
        // Almacenar el estado en localStorage
        localStorage.setItem('estadoVisible', 'sal');
    });
});
function eliminarUsu(idUser) {
    var usu = document.getElementById('usu');
    Swal.fire({
        title: "¡Aviso!",
        text: "¿Seguro que quieres eliminar a este Usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            var eliminando = new XMLHttpRequest();
            eliminando.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "¡El usuario ha sido eliminado!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "../php/homeAd.php";
                        usu.style.display="block";
                    });
                }
            };
            eliminando.open("POST", "../php/eliminarUsu.php", true);
            eliminando.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            eliminando.send("id=" + idUser);
        }
    });
}
function eliminarSal(idSal) {
    var usu = document.getElementById('usu');
    Swal.fire({
        title: "¡Aviso!",
        text: "¿Seguro que quieres eliminar esta sala?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            var eliminando2 = new XMLHttpRequest();
            eliminando2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "¡La mesa ha sido eliminada!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "../php/homeAd.php";
                        usu.style.display="block";
                    });
                }
            };
            eliminando2.open("POST", "../php/eliminarSal.php", true);
            eliminando2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            eliminando2.send("idSal=" + idSal);
        }
    });
}
function eliminarMes(idMes) {
    var usu = document.getElementById('usu');
    Swal.fire({
        title: "¡Aviso!",
        text: "¿Seguro que quieres eliminar esta sala?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            var eliminando2 = new XMLHttpRequest();
            eliminando2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "¡La mesa ha sido eliminada!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "../php/homeAd.php";
                        usu.style.display="block";
                    });
                }
            };
            eliminando2.open("POST", "../php/eliminarMes.php", true);
            eliminando2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            eliminando2.send("idMes=" + idMes);
        }
    });
}
function modMes(mod1) {
    var usu = document.getElementById('usu');
    Swal.fire({
        title: "¡Aviso!",
        text: "¿Seguro de esto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            var eliminando2 = new XMLHttpRequest();
            eliminando2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire({
                        title: "¡Hecho!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "../php/homeMa.php";
                        usu.style.display="block";
                    });
                }
            };
            eliminando2.open("POST", "../php/modMes.php", true);
            eliminando2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            eliminando2.send("idMes=" + mod1);
        }
    });
}
function modSal(mod3) {
    var usu = document.getElementById('usu');
    Swal.fire({
        title: "¡Aviso!",
        text: "¿Seguro de esto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            var eliminando2 = new XMLHttpRequest();
            eliminando2.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire({
                        title: "¡Hecho!",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "../php/homeMa.php";
                        usu.style.display="block";
                    });
                }
            };
            eliminando2.open("POST", "../php/modSal.php", true);
            eliminando2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            eliminando2.send("idSal=" + mod3);
        }
    });
}
function editarUsu(idU,userU,nombreU,salarioU,teleU,rolU){
    var ediUsu = document.getElementById('ediUsu');
    ediUsu.style.display="block";
    document.getElementById('idU').value = idU;
    document.getElementById('userU').value = userU;
    document.getElementById('nombreU').value = nombreU;
    document.getElementById('salU').value = salarioU;
    document.getElementById('telU').value = teleU;
    document.getElementById('rolU').value = rolU;
}
function editarSal(idU,userU,estadoS){
    var ediSal = document.getElementById('ediSalas');
    ediSal.style.display="block";
    document.getElementById('idS').value = idU;
    document.getElementById('salaS').value = userU;
    document.getElementById('estadoS').value = estadoS;
}
function editarMes(idMesa, nombreMesa, sillas, idEstadoMesa, idSalaMesa) {
    var formEdiMes = document.getElementById('nuevoMesas');
    formEdiMes.style.display = "block";
    document.getElementById('id_mesa').value = idMesa;
    document.getElementById('nombre_mesa').value = nombreMesa;
    document.getElementById('sillas').value = sillas;
    document.getElementById('id_estado_mesa').value = idEstadoMesa;
    document.getElementById('id_sala_mesa').value = idSalaMesa;
}
function mostrarUsu(){
    var nuevoUsu = document.getElementById('nuevoUsu');
    nuevoUsu.style.display = "block";
}
function mostrarSal(){
    var nuevoSalas = document.getElementById('nuevoSalas');
    nuevoSalas.style.display = "block";
}
function mostrarMes(){
    var nuevoMesas2 = document.getElementById('nuevoMesas2');
    nuevoMesas2.style.display = "block";
}
function ocultar(){
    var ediUsu = document.getElementById('ediUsu');
    ediUsu.style.display="none";
    var ediSal = document.getElementById('ediSalas');
    ediSal.style.display="none";
    var formEdiMes = document.getElementById('nuevoMesas');
    formEdiMes.style.display = "none";
    var nuevoUsu = document.getElementById('nuevoUsu');
    nuevoUsu.style.display = "none";
    var nuevoSalas = document.getElementById('nuevoSalas');
    nuevoSalas.style.display = "none";
    var nuevoMesas2 = document.getElementById('nuevoMesas2');
    nuevoMesas2.style.display = "none";
    document.querySelector('.volver').addEventListener('click', function (event) {
        event.preventDefault();
        ocultar();
    });
}
function ocultar2(){
    var silles = document.getElementById('silles');
    silles.style.display="none";
}

function modSi(id,silla){
    var silles = document.getElementById('silles');
    silles.style.display="block";
    console.log(silla);
    document.getElementById('silo').value = id;
    document.getElementById('sillass').value = silla;
}
function validarFormulario() {
    var idMesaInput = document.getElementById('silo');
    var numSillasInput = document.getElementById('sillass');
    var idMesa = idMesaInput.value;
    var numSillas = numSillasInput.value;

    idMesaInput.classList.remove('error');
    numSillasInput.classList.remove('error');

    if (idMesa.trim() === "" || isNaN(idMesa) || numSillas.trim() === "" || isNaN(numSillas)) {
        if (idMesa.trim() === "" || isNaN(idMesa)) {
            idMesaInput.classList.add('error');
        }
        if (numSillas.trim() === "" || isNaN(numSillas)) {
            numSillasInput.classList.add('error');
        }
        return false;
    }
    return true;
}

function validarFormulario2() {
    var idUsuarioInput = document.getElementById('idU');
    var usuarioInput = document.getElementById('userU');
    var nombreInput = document.getElementById('nombreU');
    var salarioInput = document.getElementById('salU');
    var telefonoInput = document.getElementById('telU');
    var rolInput = document.getElementById('rolU');

    idUsuarioInput.classList.remove('error');
    usuarioInput.classList.remove('error');
    nombreInput.classList.remove('error');
    salarioInput.classList.remove('error');
    telefonoInput.classList.remove('error');
    rolInput.classList.remove('error');

    var idUsuario = idUsuarioInput.value;
    var usuario = usuarioInput.value;
    var nombre = nombreInput.value;
    var salario = salarioInput.value;
    var telefono = telefonoInput.value;
    var rol = rolInput.value;

    if (
        idUsuario.trim() === "" ||
        usuario.trim() === "" ||
        nombre.trim() === "" ||
        salario.trim() === "" ||
        telefono.trim() === "" ||
        rol.trim() === ""
    ) {
        if (idUsuario.trim() === "") {
            idUsuarioInput.classList.add('error');
        }
        if (usuario.trim() === "") {
            usuarioInput.classList.add('error');
        }
        if (nombre.trim() === "") {
            nombreInput.classList.add('error');
        }
        if (salario.trim() === "") {
            salarioInput.classList.add('error');
        }
        if (telefono.trim() === "") {
            telefonoInput.classList.add('error');
        }
        if (rol.trim() === "") {
            rolInput.classList.add('error');
        }
        return false;
    }

    if (isNaN(salario)) {
        salarioInput.classList.add('error');
        return false;
    }

    if (telefono.length != 9) {
        telefonoInput.classList.add('error');
        return false;
    }

    return true;
}
function validarFormulario3() {
    var usuarioInput = document.getElementById('userU2');
    var nombreInput = document.getElementById('nombreU2');
    var salarioInput = document.getElementById('salU2');
    var telefonoInput = document.getElementById('telU2');
    var rolInput = document.getElementById('rolU2');

    // Eliminar clases de errores existentes
    usuarioInput.classList.remove('error');
    nombreInput.classList.remove('error');
    salarioInput.classList.remove('error');
    telefonoInput.classList.remove('error');
    rolInput.classList.remove('error');

    var usuario = usuarioInput.value;
    var nombre = nombreInput.value;
    var salario = salarioInput.value;
    var telefono = telefonoInput.value;
    var rol = rolInput.value;

    if (
        usuario.trim() === "" ||
        nombre.trim() === "" ||
        salario.trim() === "" ||
        telefono.trim() === "" ||
        rol.trim() === ""
    ) {
        // Agregar clases de errores
        if (usuario.trim() === "") {
            usuarioInput.classList.add('error');
        }
        if (nombre.trim() === "") {
            nombreInput.classList.add('error');
        }
        if (salario.trim() === "") {
            salarioInput.classList.add('error');
        }
        if (telefono.trim() === "") {
            telefonoInput.classList.add('error');
        }
        if (rol.trim() === "") {
            rolInput.classList.add('error');
        }
        return false;
    }

    if (isNaN(salario) || (telefono.length != 9)) {
        // Agregar clases de errores
        if (isNaN(salario)) {
            salarioInput.classList.add('error');
        }
        if (telefono.length != 9) {
            telefonoInput.classList.add('error');
        }
        return false;
    }

    return true;
}
function validarFormulario4() {
    var idSalaInput = document.getElementById('idS');
    var salaInput = document.getElementById('salaS');
    var estadoInput = document.getElementById('estadoS');

    idSalaInput.classList.remove('error');
    salaInput.classList.remove('error');
    estadoInput.classList.remove('error');

    var idSala = idSalaInput.value;
    var sala = salaInput.value;
    var estado = estadoInput.value;

    if (
        idSala.trim() === "" ||
        sala.trim() === "" ||
        estado.trim() === ""
    ) {
        if (idSala.trim() === "") {
            idSalaInput.classList.add('error');
        }
        if (sala.trim() === "") {
            salaInput.classList.add('error');
        }
        if (estado.trim() === "") {
            estadoInput.classList.add('error');
        }
        return false;
    }
    return true;
}
function validarFormulario5() {
    var salaInput = document.getElementById('salaS2');
    var estadoInput = document.getElementById('estadoS2');

    salaInput.classList.remove('error');
    estadoInput.classList.remove('error');

    var sala = salaInput.value;
    var estado = estadoInput.value;

    if (
        sala.trim() === "" ||
        estado.trim() === ""
    ) {
        if (sala.trim() === "") {
            salaInput.classList.add('error');
        }
        if (estado.trim() === "") {
            estadoInput.classList.add('error');
        }
        return false;
    }

    return true;
}
function validarFormulario6() {
    var idMesaInput = document.getElementById('id_mesa');
    var nombreMesaInput = document.getElementById('nombre_mesa');
    var idSalaMesaInput = document.getElementById('id_sala_mesa');
    var idEstadoMesaInput = document.getElementById('id_estado_mesa');
    var sillasInput = document.getElementById('sillas');

    idMesaInput.classList.remove('error');
    nombreMesaInput.classList.remove('error');
    idSalaMesaInput.classList.remove('error');
    idEstadoMesaInput.classList.remove('error');
    sillasInput.classList.remove('error');

    var idMesa = idMesaInput.value;
    var nombreMesa = nombreMesaInput.value;
    var idSalaMesa = idSalaMesaInput.value;
    var idEstadoMesa = idEstadoMesaInput.value;
    var sillas = sillasInput.value;

    if (
        idMesa.trim() === "" ||
        nombreMesa.trim() === "" ||
        idSalaMesa.trim() === "" ||
        idEstadoMesa.trim() === "" ||
        sillas.trim() === ""
    ) {
        if (idMesa.trim() === "") {
            idMesaInput.classList.add('error');
        }
        if (nombreMesa.trim() === "") {
            nombreMesaInput.classList.add('error');
        }
        if (idSalaMesa.trim() === "") {
            idSalaMesaInput.classList.add('error');
        }
        if (idEstadoMesa.trim() === "") {
            idEstadoMesaInput.classList.add('error');
        }
        if (sillas.trim() === "") {
            sillasInput.classList.add('error');
        }
        return false;
    }

    if (isNaN(sillas)) {
        sillasInput.classList.add('error');
        return false;
    }

    return true;
}
function validarFormulario7() {
    var nombreMesaInput = document.getElementById('nombre_mesa2');
    var idSalaMesaInput = document.getElementById('id_sala_mesa2');
    var idEstadoMesaInput = document.getElementById('id_estado_mesa2');
    var sillasInput = document.getElementById('sillas2');

    nombreMesaInput.classList.remove('error');
    idSalaMesaInput.classList.remove('error');
    idEstadoMesaInput.classList.remove('error');
    sillasInput.classList.remove('error');

    var nombreMesa = nombreMesaInput.value;
    var idSalaMesa = idSalaMesaInput.value;
    var idEstadoMesa = idEstadoMesaInput.value;
    var sillas = sillasInput.value;

    if (
        nombreMesa.trim() === "" ||
        idSalaMesa.trim() === "" ||
        idEstadoMesa.trim() === "" ||
        sillas.trim() === ""
    ) {
        if (nombreMesa.trim() === "") {
            nombreMesaInput.classList.add('error');
        }
        if (idSalaMesa.trim() === "") {
            idSalaMesaInput.classList.add('error');
        }
        if (idEstadoMesa.trim() === "") {
            idEstadoMesaInput.classList.add('error');
        }
        if (sillas.trim() === "") {
            sillasInput.classList.add('error');
        }
        return false;
    }

    if (isNaN(sillas)) {
        sillasInput.classList.add('error');
        return false;
    }

    return true;
}