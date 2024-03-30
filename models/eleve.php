<?php
include_once('compte.php');

class Eleve extends Compte {
    private $promotion;

    public function getPromotion() {
        return $this->promotion;
    }
}

class ElevesService {
    // avoir un eleve unique par son ID
    public static function getById($id) {
        global $db;
        $result = $db->query(
            'SELECT * FROM eleve INNER JOIN compte on eleve.id_compte = compte.id_compte WHERE eleve.id_compte = ?',
            [$id]
        );
        if (empty($result)) {
            return null;
        }
        return new Eleve($result[0]);
    }

    // avoir un eleve unique par son nom d'utilisateur
    public static function getByUsername($username) {
        global $db;
        $result = $db->query(
            'SELECT * FROM eleve INNER JOIN compte on eleve.id_compte = compte.id_compte WHERE compte.nomutilisateur = ?',
            [$username]
        );
        if (empty($result)) {
            return null;
        }
        return new Eleve($result[0]);
    }
}