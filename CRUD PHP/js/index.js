// Obtener el botón "Agregar nuevo Usuario"
var btnAgregarUser = document.getElementById("agregarUser");

// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando se hace clic en el botón "Agregar nuevo Usuario", abre el modal
btnAgregarUser.onclick = function() {
    modal.style.display = "block";
    document.getElementById("modalTitle").textContent = "Agregar Usuario";
    document.getElementById("submitButton").textContent = "Agregar";
}

// Cuando se hace clic en <span> (x), cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario hace clic en cualquier lugar fuera del modal, ciérralo
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Función para abrir el modal en modo edición
// Función para abrir el modal en modo edición
function abrirModalEdicion() {
    // Obtener el modal
    var modal = document.getElementById("myModal");
    
    // Mostrar el modal
    modal.style.display = "block";

    // Cambiar el título del modal
    document.getElementById("modalTitle").textContent = "Editar Usuario";

    // Cambiar el texto del botón de envío del formulario
    document.getElementById("submitButton").textContent = "Actualizar";

    
}


function desmarcarFemenino() {
    if (document.getElementById("masculino").checked) {
        document.getElementById("femenino").checked = false;
    }
}

function desmarcarMasculino() {
    if (document.getElementById("femenino").checked) {
        document.getElementById("masculino").checked = false;
    }
}

// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario hace clic en <span> (x), cierra el modal y desmarca los checkboxes
span.onclick = function() {
    cerrarModal();
    limpiarModal();
}

// Cuando el usuario hace clic fuera del modal, cierra el modal y desmarca los checkboxes
window.onclick = function(event) {
    if (event.target == modal) {
        cerrarModal();
        limpiarModal();
    }
}

// Función para cerrar el modal y desmarcar los checkboxes
function cerrarModal() {
    modal.style.display = "none";
    document.getElementById("masculino").checked = false;
    document.getElementById("femenino").checked = false;
    limpiarModal();
}



function limpiarModal() {
    // Obtén referencias a los elementos de los campos del formulario
    const nombreInput = document.getElementById('nombre');
    const apellidoInput = document.getElementById('apellido');
    const correoInput = document.getElementById('correo');
    const telefonoInput = document.getElementById('telefono');
    const dniInput = document.getElementById('dni');
    const edadInput = document.getElementById('edad');
    const masculinoCheckbox = document.getElementById('masculino');
    const femeninoCheckbox = document.getElementById('femenino');

    // Limpia los valores de los campos del formulario
    nombreInput.value = '';
    apellidoInput.value = '';
    correoInput.value = '';
    telefonoInput.value = '';
    dniInput.value = '';
    edadInput.value = '';
    masculinoCheckbox.checked = false;
    femeninoCheckbox.checked = false;
}
