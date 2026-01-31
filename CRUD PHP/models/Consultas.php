<?php
require_once 'Conexion.php';

class Consultas extends Conexion
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexion::getConexion();
    }

    public function listarDatosTbl()
    {
        $sql = "SELECT * FROM usuario";
        $consultapreparada = $this->pdo->prepare($sql);
        $consultapreparada->execute();

        return $consultapreparada->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarID($params = [])
    {
        $sql = "SELECT * FROM usuario WHERE idUsuario = ?";
        $idBuscado = $this->pdo->prepare($sql);
        $idBuscado->execute(
            [$params['idUsuario']]
        );

        return $idBuscado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarFila($params = [])
    {
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        $eliminar = $this->pdo->prepare($sql);
        $eliminar->execute(
            [$params['idUsuario']]
        );
    }

    public function add($params = [])
    {
        $sql = "INSERT INTO usuario (nombres, apellidos, correo, telefono, dni, edad, sexo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert = $this->pdo->prepare($sql);
        $insert->execute([
            $params['nombres'],
            $params['apellidos'],
            $params['correo'],
            $params['telefono'],
            $params['dni'],
            $params['edad'],
            $params['sexo']
        ]);
    }

    public function editarFila($params = [])
    {
        try {
            // Validar los parámetros (por ejemplo, asegurarse de que todos los campos necesarios estén presentes)

            $sql = "UPDATE usuario SET nombres=?, apellidos=?, correo=?, telefono=?, dni=?, edad=?, sexo=? WHERE idUsuario=?";
            $editar = $this->pdo->prepare($sql);
            $editar->execute([
                $params['nombres'],
                $params['apellidos'],
                $params['correo'],
                $params['telefono'],
                $params['dni'],
                $params['edad'],
                $params['sexo'],
                $params['idUsuario']
            ]);

            // Verificar si se actualizó correctamente
            if ($editar->rowCount() > 0) {
                // La fila se actualizó correctamente
                return true;
            } else {
                // La fila no se actualizó, puede que el idUsuario no exista
                return false;
            }
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            // Por ejemplo, podrías registrar el error o lanzar una excepción personalizada
            return false;
        }
    }
}
$consultas = new Consultas();
