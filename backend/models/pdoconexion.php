<?php
class PDOConnection {

    private $ipServidor = "localhost";
    private $usuarioBase = "root";
    private $contrasena = "";
    private $nombreBaseDatos = "juegomillonarios";

    private $conexion; 


    public function conectar() {
        $dsn = "mysql:host={$this->ipServidor};dbname={$this->nombreBaseDatos};charset=utf8mb4";

        try {
            $this->conexion = new PDO(
                $dsn,
                $this->usuarioBase,
                $this->contrasena,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
                ]
            );
            return $this->conexion;
        } catch (PDOException $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public function getConexion() {
        if (!$this->conexion) {
            $this->conectar(); 
        }
        return $this->conexion;
    }
    public function desconectar() {
        $this->conexion = null;
    }

}
?>