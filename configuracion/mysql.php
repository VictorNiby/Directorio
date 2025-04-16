<?php

class Mysql{
    public $conect;
    private $DB_HOST;
    private $DB_NAME;
    private $DB_PORT;
    private $DB_USERNAME;
    private $DB_PASSWORD;
    private $DB_CHARSET;
    
    public function __construct(){

        $env = parse_ini_file('.env');
        $this->DB_HOST = $env["DB_HOST"];
        $this->DB_NAME = $env["DB_NAME"];
        $this->DB_PORT = $env["DB_PORT"];
        $this->DB_USERNAME = $env["DB_USERNAME"];
        $this->DB_PASSWORD = $env["DB_PASSWORD"];
        $this->DB_CHARSET = $env["DB_CHARSET"];

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