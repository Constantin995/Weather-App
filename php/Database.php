<?php

class Database
{

    public $db_name;
    public $db_host;
    public $db_pass;
    public $db_serv;
    public $table;
    public $charset;
    public $pdo;

    public function __construct()
    {

        $this->db_name = 'portofolio';
        $this->db_host = 'localhost';
        $this->db_pass = '';
        $this->db_serv = 'root';
        $this->table = 'weather';
        $this->charset = 'utf8mb4';


        try {

            $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->charset";
            $this->pdo = new PDO($dsn, $this->db_serv, $this->db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo 'Conexsiunea a esuat' . $e->getMessage();
        }
    }


    public function insertData($nume, $prenume, $parola)
    {
        $sql = 'INSERT INTO weather(nume,prenume,parola) VALUES (?, ?, ?)';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nume, $prenume, $parola]);
    }
}
