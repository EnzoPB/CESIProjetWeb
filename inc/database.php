<?php

class Database {
    public $pdo;

    public function __construct($host, $database, $username, $password) {
        global $config;

        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
    
        if ($config['debug']) {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }    
    }

    public function query($queryString, $data = []) {
        $query = $this->pdo->prepare($queryString);
        $query->execute($data);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}