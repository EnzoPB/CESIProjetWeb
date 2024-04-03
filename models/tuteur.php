<?php
include_once('compte.php');
include_once('service.php');

class Tuteur extends Compte {
    public function creer() {
        global $bdd;
        // on appelle la méthode de Compte pour inserer toutes les données initiales
        parent::creer();
        // puis on ajoute la ligne dans la table tuteur
        $bdd->req('INSERT INTO tuteur(id_compte) VALUES(?)', [
            $this->getId()
        ]);
    }
}

class TuteursService extends ServiceBase {
    protected static $table = 'tuteur';
    protected static $colonneId = 'id_compte';
    protected static $classe = 'Tuteur';
    protected static $requeteGet = 'SELECT * FROM tuteur INNER JOIN compte ON tuteur.id_compte = compte.id_compte WHERE compte.{cle} = ?';

    public static function getByUsername($nomUtilisateur) {
        return self::getOneBy('nomUtilisateur', $nomUtilisateur);
    }
}