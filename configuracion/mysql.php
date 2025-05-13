
<?php

class Mysql{
    public $conect;
    private $DB_HOST = 'localhost';
    private $DB_NAME = 'directorio';
    private $DB_PORT = '3306';
    private $DB_USERNAME = 'root';
    private $DB_PASSWORD = '';
    private $DB_CHARSET = 'utf8mb4';
    
    public function __construct(){

        $connectionString = "mysql:host=".$this->DB_HOST. ";dbname=".$this->DB_NAME.";port=".$this->DB_PORT.";charset=".$this->DB_CHARSET;

        try{
            $this->conect = new PDO($connectionString, $this->DB_USERNAME, $this->DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){

            echo "CONNECTION ERROR: " . $e->getMessage();
        }
    }

    public function conect(){
        return $this->conect;
    }
}