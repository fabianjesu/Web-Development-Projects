<?php
require_once '../models/Consultas.php';

function devolverDatos()
{
    $consulta = new Consultas();
    $datos = json_encode($consulta->listarDatosTbl());
    return json_decode($datos, true);
}

function devolverDatoId()
{
    $consulta = new Consultas();

    // Verificar si el parámetro 'busqueda' está presente y no está vacío
    if ($_GET['busqueda'] !== '') {
        $id = $_GET['busqueda'];
        $params = ['idUsuario' => $id];
        echo json_encode($consulta->buscarID($params), true);
    } else {
        // Si 'busqueda' está vacío, devolver todos los registros
        echo json_encode($consulta->listarDatosTbl(), true);
    }
}

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] == 'get') {
        devolverDatoId();
    }
}

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] == 'getID') {
        devolverDatoId();
    }
}

function eliminarId()
{
    $consulta = new Consultas();
    $id = $_GET['id'];
    $params = ['idUsuario' => $id];
    echo json_encode($consulta->eliminarFila($params), true);
}

if (isset($_GET['operacion'])) {
    if ($_GET['operacion'] == 'delete') {
        $consulta = new Consultas();
        $id = $_GET['id'];
        $params = ['idUsuario' => $id];
        echo json_encode($consulta->eliminarFila($params), true);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    if ($_GET['operacion'] === 'update') {
        $consulta = new Consultas();
        $datosRecibidos = json_decode(file_get_contents('php://input'), true);
        $envio = [
            'nombres'    => $datosRecibidos['nombres'],
            'apellidos' => $datosRecibidos['apellidos'],
            'correo'    => $datosRecibidos['correo'],
            'telefono'  => $datosRecibidos['telefono'],
            'dni'       => $datosRecibidos['dni'],
            'edad'      => $datosRecibidos['edad'],
            'sexo'      => $datosRecibidos['sexo'],
            'idUsuario' => $datosRecibidos['idUsuario']
        ];
        $consulta->editarFila($envio);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['operacion'] == 'post') {
        $consulta = new Consultas();
        $datosRecibidos = json_decode(file_get_contents('php://input'), true);
        $envio = [
            'nombres'    => $datosRecibidos['nombres'],
            'apellidos' => $datosRecibidos['apellidos'],
            'correo'    => $datosRecibidos['correo'],
            'telefono'  => $datosRecibidos['telefono'],
            'dni'       => $datosRecibidos['dni'],
            'edad'      => $datosRecibidos['edad'],
            'sexo'      => $datosRecibidos['sexo']
        ];
        $consulta->add($envio);
    }
}
