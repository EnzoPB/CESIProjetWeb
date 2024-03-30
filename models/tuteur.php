<?php
include_once('compte.php');

class Tuteur extends Compte {}

class TuteursService {
    // avoir un tuteur unique par son ID
    public static function getById($id) {
        global $db;
        $result = $db->query(
            'SELECT * FROM tuteur INNER JOIN compte on tuteur.id_compte = compte.id_compte WHERE tuteur.id_compte = ?',
            [$id]
        );
        if (empty($result)) {
            return null;
        }
        return new Tuteur($result[0]);
    }

    // avoir un tuteur unique par son nom d'utilisateur
    public static function getByUsername($username) {
        global $db;
        $result = $db->query(
            'SELECT * FROM tuteur INNER JOIN compte on tuteur.id_compte = compte.id_compte WHERE compte.nomutilisateur = ?',
            [$username]
        );
        if (empty($result)) {
            return null;
        }
        return new Tuteur($result[0]);
    }
}