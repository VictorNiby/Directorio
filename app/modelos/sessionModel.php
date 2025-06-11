<?php
require_once (__DIR__ . '/../../configuracion/mysql.php');

class sessionModel extends Mysql{
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function LogIn($email,$password){
        $sql = "SELECT usuario.nombre,usuario.correo,usuario.rol,usuario.foto
        FROM usuario
        WHERE usuario.correo = ? AND usuario.password = ? AND usuario.estado = 'Activo'";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email,$password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function SignUp($documento,$nombre,$correo,$password,$telefono,$nacimiento,$foto){
        $sql = "INSERT INTO usuario (documento,nombre,correo,password,telefono,nacimiento,foto,rol)
        VALUES (?,?,?,?,?,?,?'cliente')";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$documento,$nombre,$correo,$password,$telefono,$nacimiento,$foto]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}