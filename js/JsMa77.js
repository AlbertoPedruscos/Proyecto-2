var mes2 = document.getElementById('mes2');
var sal2 = document.getElementById('sal2');
var usu = document.getElementById('usu');
var mes = document.getElementById('mes');
var sal = document.getElementById('sal');
function mesas(){
   mes2.style.display="block"; 
   sal2.style.display="none";
   usu.style.display="none";
}
function salas(){
   mes2.style.display="none"; 
   sal2.style.display="block";
   usu.style.display="none"; 
}
function usuarios(){
   mes2.style.display="none"; 
   sal2.style.display="none"; 
   usu.style.display="block";
}
function mesas2(){
   mes.style.display="block"; 
   sal.style.display="none"; 
}
function salas2(){
   mes.style.display="none"; 
   sal.style.display="block"; 
}
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
    var idMesa = document.getElementById('silo').value;
    var numSillas = document.getElementById('sillass').value;
    if (idMesa.trim() === "" || isNaN(idMesa) || numSillas.trim() === "" || isNaN(numSillas)) {
        alert("Por favor, ingrese valores válidos para ID de Mesa y Número de Sillas.");
        return false;
    }
    return true;
}
function validarFormulario2() {
    var idUsuario = document.getElementById('idU').value;
    var usuario = document.getElementById('userU').value;
    var nombre = document.getElementById('nombreU').value;
    var salario = document.getElementById('salU').value;
    var telefono = document.getElementById('telU').value;
    var rol = document.getElementById('rolU').value;
    if (
        idUsuario.trim() === "" ||
        usuario.trim() === "" ||
        nombre.trim() === "" ||
        salario.trim() === "" ||
        telefono.trim() === "" ||
        rol.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }
    if (isNaN(salario)) {
        alert("Por favor, ingrese un valor válido para el salario.");
        return false;
    }
    if (isNaN(telefono)) {
        alert("Por favor, ingrese un valor válido para el teléfono.");
        return false;
    }
    return true;
}
function validarFormulario3() {
    var usuario = document.getElementById('userU2').value;
    var nombre = document.getElementById('nombreU2').value;
    var salario = document.getElementById('salU2').value;
    var telefono = document.getElementById('telU2').value;
    var rol = document.getElementById('rolU2').value;

    if (
        usuario.trim() === "" ||
        nombre.trim() === "" ||
        salario.trim() === "" ||
        telefono.trim() === "" ||
        rol.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }

    if (isNaN(salario) || isNaN(telefono)) {
        alert("Por favor, ingrese valores válidos para Salario y Teléfono.");
        return false;
    }

    return true;
}
function validarFormulario4() {
    var idSala = document.getElementById('idS').value;
    var sala = document.getElementById('salaS').value;
    var estado = document.getElementById('estadoS').value;

    if (
        idSala.trim() === "" ||
        sala.trim() === "" ||
        estado.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }

    return true;
}
function validarFormulario5() {
    var sala = document.getElementById('salaS2').value;
    var estado = document.getElementById('estadoS2').value;

    if (
        sala.trim() === "" ||
        estado.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }

    return true;
}
function validarFormulario6() {
    var idMesa = document.getElementById('id_mesa').value;
    var nombreMesa = document.getElementById('nombre_mesa').value;
    var idSalaMesa = document.getElementById('id_sala_mesa').value;
    var idEstadoMesa = document.getElementById('id_estado_mesa').value;
    var sillas = document.getElementById('sillas').value;

    if (
        idMesa.trim() === "" ||
        nombreMesa.trim() === "" ||
        idSalaMesa.trim() === "" ||
        idEstadoMesa.trim() === "" ||
        sillas.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }

    if (isNaN(sillas)) {
        alert("Por favor, ingrese un valor válido para las sillas.");
        return false;
    }

    return true;
}
function validarFormulario7() {
    var nombreMesa = document.getElementById('nombre_mesa2').value;
    var idSalaMesa = document.getElementById('id_sala_mesa2').value;
    var idEstadoMesa = document.getElementById('id_estado_mesa2').value;
    var sillas = document.getElementById('sillas2').value;

    if (
        nombreMesa.trim() === "" ||
        idSalaMesa.trim() === "" ||
        idEstadoMesa.trim() === "" ||
        sillas.trim() === ""
    ) {
        alert("Por favor, complete todos los campos del formulario.");
        return false;
    }

    if (isNaN(sillas)) {
        alert("Por favor, ingrese un valor válido para las sillas.");
        return false;
    }

    return true;
}