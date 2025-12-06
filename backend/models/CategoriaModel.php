<?php
// backend/models/CategoriaModel.php
require_once __DIR__ . '/pdoconexion.php';

class CategoriaModel {
    private $mysql;
    
    public function __construct() {
        $this->mysql = new PDOConnection();
    }
    
    /**
     * Obtiene todas las categorías ordenadas alfabéticamente
     */
    public function obtenerTodasCategorias() {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "SELECT ID_categoria, nombre_categoria 
                FROM tbl_categorias 
                ORDER BY nombre_categoria ASC";
        
        try {
            $stmt = $conexion->prepare($sql);
            $stmt->execute();
            
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $this->mysql->desconectar();
            return $categorias;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener categorías: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Obtiene una categoría específica por su ID
     */
    public function obtenerCategoriaPorId($id_categoria) {
        $this->mysql->conectar();
        $conexion = $this->mysql->getConexion();
        
        $sql = "SELECT ID_categoria, nombre_categoria 
                FROM tbl_categorias 
                WHERE ID_categoria = :id_categoria";
        
        try {
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            
            $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->mysql->desconectar();
            return $categoria;
            
        } catch (PDOException $e) {
            $this->mysql->desconectar();
            error_log("Error al obtener categoría: " . $e->getMessage());
            return null;
        }
    }
}
?>