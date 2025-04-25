
<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class CategoryModel extends Mysql{
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function GetAllCategory(){  
        $query = "SELECT * FROM categoria ORDER BY nombre ASC";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute();
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function CategoryById($id){  
        if(!is_numeric($id)) {
            throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
        }
        $query = "SELECT * FROM categoria WHERE id_categoria = ?";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$id]);
        $data = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function Insert($name){
        $name = trim($name);
        if (empty($name)) {
            throw new Exception("El nombre no puede estar vacío");
        }
        $query = "INSERT INTO categoria (nombre) VALUES(?)";
        $preparedStmt = $this->connection->prepare($query);
        $result = $preparedStmt->execute([$name]);
        return $result;
    }

    public function Update($name,$id){
        if(!is_numeric($id)) {
            throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
        }
        $query = "UPDATE categoria SET nombre = ? WHERE id_categoria = ?";
        $preparedStmt = $this->connection->prepare($query);
        $result = $preparedStmt->execute([$name,$id]);
        return $result;
    }

    public function Delete($id){
        try {
            if(!is_numeric($id)) {
                throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
            }
            $queryCategory = "SELECT estado FROM categoria WHERE id_categoria = ?";
            $preparedStmtCategory = $this->connection->prepare($queryCategory);
            $preparedStmtCategory->execute([$id]);
            $data = $preparedStmtCategory->fetch(PDO::FETCH_ASSOC);
            if(!$data) {
                throw new Exception("Categoría no encontrada");
            }
            $nuevoEstado = ($data['estado'] === 'Activo') ? 'Inactivo' : 'Activo';
            $queryUpdate = "UPDATE categoria SET estado = ? WHERE id_categoria = ?";
            $preparedStmt = $this->connection->prepare($queryUpdate);
            $result = $preparedStmt->execute([$nuevoEstado,$id]);
            return $result; 
        } catch (\Throwable $th) {
            return false;
        }
    }

    //LANDING
public function GetAllCategoryLanding(){  
    $query = "SELECT c.nombre AS categoria, COUNT(s.id_servicio) AS cantidad_servicios
    FROM categoria c
    LEFT JOIN servicio s ON c.id_categoria = s.categoria_id_categoria
    GROUP BY c.id_categoria
    ORDER BY c.nombre ASC;";
    $preparedStmt = $this->connection->prepare($query);
    $preparedStmt->execute();
    $info = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
    return $info;
}

public function GetFeaturesServices(){
    $query = "SELECT s.id_servicio, s.titulo, s.precio, COUNT(su.id) AS total_solicitudes
FROM servicio s
JOIN servicio_usuario su ON s.id_servicio = su.servicio_id
GROUP BY s.id_servicio
ORDER BY total_solicitudes DESC
LIMIT 8;";
    $preparedStmt = $this->connection->prepare($query);
    $preparedStmt->execute();
    $feature = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
    return $feature;
}
}
