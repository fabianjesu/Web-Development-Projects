<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba 4</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">

        <input type="text" id="busqueda" name="busqueda" class="form-control mb-2" placeholder="BUSQUEDA POR ID">
        <button id="btnbuscar" class="btn btn-primary mb-2">Buscar</button>

        <button id="agregarUser" class="btn btn-success mb-2">Agregar nuevo Usuario</button>

        <!-- Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content" style="width: 60%;">
                <span class="close" onclick="cerrarModal()">&times;</span>
                <h2 id="modalTitle">Agregar Usuario</h2>
                <form id="userForm">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control mb-2" required>

                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" class="form-control mb-2" required>

                    <label for="correo">Correo:</label>
                    <input type="email" id="correo" name="correo" class="form-control mb-2" required>

                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" class="form-control mb-2" required>

                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" class="form-control mb-2" required>

                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" class="form-control mb-2" required>

                    <label for="sexo">Sexo:</label>
                    <div class="mb-2">
                        <input type="checkbox" id="masculino" name="sexo" value="M" onclick="desmarcarFemenino()">
                        <label for="masculino">Masculino</label>
                        <input type="checkbox" id="femenino" name="sexo" value="F" onclick="desmarcarMasculino()">
                        <label for="femenino">Femenino</label>
                    </div>


                    <button id="submitButton" style="width: 100%;" class="btn btn-primary">Agregar</button>
                    <button id="submitActualizar" style="width: 100%; display: none" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>


        <table class="table" id="table-datos">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">NOMBRES</th>
                    <th style="text-align: center;">APELLIDOS</th>
                    <th style="text-align: center;">CORREO</th>
                    <th style="text-align: center;">TELEFONO</th>
                    <th style="text-align: center;">DNI</th>
                    <th style="text-align: center;">EDAD</th>
                    <th style="text-align: center;">SEXO</th>
                    <th style="text-align: center;">ACCION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../controller/consultas.controller.php';

                $datos = devolverDatos();

                foreach ($datos as $valor) {
                    $id = $valor['idUsuario'];
                    $botones = "<td style='text-align: center;'>
                                    <button class='btn btn-primary edit-btn' id='editarbtn' onclick='abrirModalEdicion()'>Editar</button>
                                    <button class='btn btn-danger delete-btn' data-id='{$valor['idUsuario']}'>Eliminar</button>
                                </td>";

                    $idUsuario = strtoupper($valor['idUsuario']);
                    $nombres = strtoupper($valor['nombres']);
                    $apellidos = strtoupper($valor['apellidos']);
                    $correo = strtoupper($valor['correo']);
                    $telefono = strtoupper($valor['telefono']);
                    $dni = strtoupper($valor['dni']);
                    $edad = strtoupper($valor['edad']);
                    $sexo = strtoupper($valor['sexo']);

                    echo "
        <tr>
            <td style='text-align: center;'>{$idUsuario}</td>
            <td style='text-align: center;'>{$nombres}</td>
            <td style='text-align: center;'>{$apellidos}</td>
            <td style='text-align: center;'>{$correo}</td>
            <td style='text-align: center;'>{$telefono}</td>
            <td style='text-align: center;'>{$dni}</td>
            <td style='text-align: center;'>{$edad}</td>
            <td style='text-align: center;'>{$sexo}</td>
            {$botones}
        </tr>
    ";
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="../js/index.js"></script>
    <script>
        const txt = document.getElementById("busqueda");
        document.getElementById("btnbuscar").addEventListener("click", () => {

            function getUserID() {

                fetch(`../controller/consultas.controller.php?operacion=getID&busqueda=${txt.value}`, {
                        method: 'GET'
                    })
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        const table = document.querySelector("#table-datos tbody");
                        table.innerHTML = "";

                        datos.forEach(element => {

                            const tr = document.createElement('tr');
                            const $botones = `<td style="text-align: center;">
                                                <button class="btn btn-primary edit-btn" onclick="abrirModalEdicion()">Editar</button>
                                                <button class="btn btn-danger delete-btn" data-id='${element.idUsuario}'>Eliminar</button>
                                              </td>`;


                            const idUsuario = element.idUsuario;
                            const nombres = element.nombres;
                            const apellidos = element.apellidos;
                            const correo = element.correo;
                            const telefono = element.telefono;
                            const dni = element.dni;
                            const edad = element.edad;
                            const sexo = element.sexo;

                            tr.innerHTML = `
                            <td style='text-align: center;'>${idUsuario}</td>
                            <td style='text-align: center;'>${nombres}</td>
                            <td style='text-align: center;'>${apellidos}</td>
                            <td style='text-align: center;'>${correo}</td>
                            <td style='text-align: center;'>${telefono}</td>
                            <td style='text-align: center;'>${dni}</td>
                            <td style='text-align: center;'>${edad}</td>
                            <td style='text-align: center;'>${sexo}</td>
                            ${$botones}
                            `;

                            table.appendChild(tr);

                            let botones = document.querySelectorAll('.delete-btn');
                            botones.forEach((boton) => {
                                boton.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    let id = e.target.getAttribute('data-id');
                                    fetch(`../controller/consultas.controller.php?operacion=delete&id=${id}`, {
                                            method: 'DELETED'
                                        })
                                        .then(datos => {
                                            window.location.reload();
                                            console.log("Dato eliminado");
                                        })
                                });
                            });
                        });

                    })
                    .catch(error => console.log(error));
            };

            getUserID()
        });

        let botones = document.querySelectorAll('.delete-btn');
        botones.forEach((boton) => {
            boton.addEventListener('click', (e) => {
                e.preventDefault();
                let id = e.target.getAttribute('data-id');
                fetch(`../controller/consultas.controller.php?operacion=delete&id=${id}`, {
                        method: 'DELETED'
                    })
                    .then(datos => {
                        window.location.reload();
                        console.log("Dato eliminado");
                    })
            });
        });

        document.getElementById('submitButton').addEventListener("click", (event) => {
            event.preventDefault();

            const nombres = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const correo = document.getElementById('correo').value;
            const telefono = document.getElementById('telefono').value;
            const dni = document.getElementById('dni').value;
            const edad = document.getElementById('edad').value;

            // Verificar si el checkbox masculino está marcado
            const masculinoCheckbox = document.getElementById('masculino');
            const femeninoCheckbox = document.getElementById('femenino');
            let sexo;
            if (masculinoCheckbox.checked) {
                sexo = 'M'; // Establecer el valor masculino si está marcado
            } else if (femeninoCheckbox.checked) {
                sexo = 'F'; // Establecer el valor femenino si está marcado
            } else {
                sexo = ''; // Manejar el caso donde ninguno está marcado
            }

            const parametros = {
                "nombres": nombres,
                "apellidos": apellido,
                "correo": correo,
                "telefono": telefono,
                "dni": dni,
                "edad": edad,
                "sexo": sexo,
            };

            // Convertir el objeto 'parametros' a formato JSON
            const body = JSON.stringify(parametros);

            // Opciones que se envían en la solicitud fetch
            const opciones = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' // Establecer la cabecera Content-Type a application/json
                },
                body: body
            };

            // Paso 03: URL del controlador
            const url = '../controller/consultas.controller.php?operacion=post';

            // Paso 04: Realizar la solicitud fetch
            fetch(url, opciones)
                .then(respuesta => respuesta.text())
                .then(datos => {
                    // Manejar la respuesta del servidor aquí
                    document.getElementById('userForm').reset();
                    cerrarModal();
                    window.location.reload();
                })
                .catch(error => console.log(error));
        });


        document.addEventListener("DOMContentLoaded", function() {
            const btnEditar = document.querySelectorAll(".edit-btn");
            btnEditar.forEach(btn => {
                btn.addEventListener("click", (event) => {
                    event.preventDefault();
                    document.getElementById("submitButton").style.display = "none";
                    document.getElementById("submitActualizar").style.display = "block";

                    const id = event.target.parentNode.querySelector('.delete-btn').getAttribute('data-id');
                    console.log(id);

                    // Obtener cada input por su id y asignarlo a una variable
                    const nombres = document.getElementById('nombre');
                    const apellido = document.getElementById('apellido');
                    const correo = document.getElementById('correo');
                    const telefono = document.getElementById('telefono');
                    const dni = document.getElementById('dni');
                    const edad = document.getElementById('edad');

                    // Verificar si el checkbox masculino está marcado
                    const masculinoCheckbox = document.getElementById('masculino');
                    const femeninoCheckbox = document.getElementById('femenino');
                    let sexo;
                    if (masculinoCheckbox.checked) {
                        sexo = 'M'; // Establecer el valor masculino si está marcado
                    } else if (femeninoCheckbox.checked) {
                        sexo = 'F'; // Establecer el valor femenino si está marcado
                    } else {
                        sexo = ''; // Manejar el caso donde ninguno está marcado
                    }

                    const url = `../controller/consultas.controller.php?operacion=get&busqueda=${id}`;
                    fetch(url, {
                            method: 'GET'
                        })
                        .then(respuesta => respuesta.json())
                        .then(datos => {
                            datos.forEach(element => {
                                nombres.value = element.nombres;
                                apellido.value = element.apellidos;
                                correo.value = element.correo;
                                telefono.value = element.telefono;
                                dni.value = element.dni;
                                edad.value = element.edad;
                                sexo = element.sexo;

                                // Verificar si el sexo es 'M'
                                if (sexo === 'M') {
                                    // Marcar el checkbox masculino
                                    masculinoCheckbox.checked = true;
                                    // Desmarcar el checkbox femenino
                                    femeninoCheckbox.checked = false;
                                } else if (sexo === 'F') {
                                    // Marcar el checkbox femenino
                                    femeninoCheckbox.checked = true;
                                    // Desmarcar el checkbox masculino
                                    masculinoCheckbox.checked = false;
                                }

                            });
                        });

                    document.getElementById("submitActualizar").addEventListener("click", (event) => {
                        event.preventDefault();

                        let nombres = document.getElementById('nombre').value;
                        let apellido = document.getElementById('apellido').value;
                        let correo = document.getElementById('correo').value;
                        let telefono = document.getElementById('telefono').value;
                        let dni = document.getElementById('dni').value;
                        let edad = document.getElementById('edad').value;

                        // Verificar si el checkbox masculino está marcado
                        let masculinoCheckbox = document.getElementById('masculino');
                        let femeninoCheckbox = document.getElementById('femenino');
                        let sexo = '';
                        if (masculinoCheckbox.checked) {
                            sexo = 'M'; // Establecer el valor masculino si está marcado
                        } else if (femeninoCheckbox.checked) {
                            sexo = 'F'; // Establecer el valor femenino si está marcado
                        }

                        const parametros = {
                            "nombres": nombres,
                            "apellidos": apellido,
                            "correo": correo,
                            "telefono": telefono,
                            "dni": dni,
                            "edad": edad,
                            "sexo": sexo,
                            "idUsuario": id
                        };

                        // Convertir el objeto 'parametros' a formato JSON
                        const body = JSON.stringify(parametros);

                        // Opciones que se envían en la solicitud fetch
                        const opciones = {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json' // Establecer la cabecera Content-Type a application/json
                            },
                            body: body
                        };

                        // URL del controlador
                        const url = '../controller/consultas.controller.php?operacion=update';

                        // Realizar la solicitud fetch
                        fetch(url, opciones)
                            .then(respuesta => respuesta.text())
                            .then(datos => {
                                // Manejar la respuesta del servidor aquí
                                document.getElementById('userForm').reset();
                                cerrarModal();
                                window.location.reload();
                            })
                            .catch(error => console.log(error));
                    });


                });

            });
        });
    </script>
</body>

</html>