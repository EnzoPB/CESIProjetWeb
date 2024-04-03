<?php
include_once('tuteur.php');
include_once('service.php');

class Competence {
    private $id;
    private $nom;

    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function __construct($competenceObj = null) {
        // on remplit les attributs avec l'array en paramètre
        if ($competenceObj != null) {
            $this->id = $competenceObj['id_competence'];
            $this->nom = $competenceObj['nom'];
        }
    }

}


class CompetenceService extends ServiceBase {
    protected static $table = 'competence';
    protected static $colonneId = 'id_competence';
    protected static $classe = 'Competence';

    public static function getByEleve($eleve) {
        global $bdd;
        return $bdd->req('SELECT * FROM eleve_competence INNER JOIN competence ON competence.id_competence = eleve_competence.id_competence WHERE id_compte=?', [
            $eleve->getId()
        ]);
    }
}