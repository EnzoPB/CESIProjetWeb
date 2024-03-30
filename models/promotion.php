<?php
include_once('tuteur.php');

class Promotion {
    private $id;
    private $nom;
    private $specialite;
    private $annee;
    private $tuteurId;

    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getSpecialite() {
        return $this->specialite;
    }
    
    public function getAnnee() {
        return $this->annee;
    }
    
    public function getTuteur() {
        return TuteursService::getById($this->tuteurId);
    }

    public function __construct($promotionObj = null) {
        // on remplit les attributs avec l'array en paramètre
        if ($promotionObj != null) {
            $this->id = $promotionObj['id_promotion'];
            $this->nom = $promotionObj['nom'];
            $this->specialite = $promotionObj['specialite'];
            $this->annee = $promotionObj['annee'];
            $this->tuteurId = $promotionObj['id_compte'];
        }
    }

}


class PromotionsService {
    // avoir une promotion unique par son ID
    public static function getById($id) {
        global $db;
        $result = $db->query(
            'SELECT * FROM promotion WHERE id_promotion = ?',
            [$id]
        );
        if (empty($result)) {
            return null;
        }
        return new Promotion($result[0]);
    }
}