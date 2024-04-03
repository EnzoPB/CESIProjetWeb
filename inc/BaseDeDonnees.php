<?php

class BaseDeDonnees {
    public $pdo;

    public function __construct($host, $database, $username, $password) {
        global $config;

        $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
    
        if ($config['debug']) {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }    
    }

    public function req($reqString, $donnees = []) {
        $req = $this->pdo->prepare($reqString);
        $req->execute($donnees);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function dernierId() {
        return $this->pdo->lastInsertId();
    }
}