<?php
include_once('compte.php');
include_once('promotion.php');
include_once('service.php');

class Eleve extends Compte {
    private $promotionId;

    public function getPromotion() {
        return PromotionsService::getById($this->promotionId);
    }
    public function setPromotion($promotion) {
        $this->promotionId = $promotion->getId();
    }

    public function modifier() {
        global $bdd;
        // on appelle la méthode de Compte (pour modifier tout les champs de Compte)
        parent::modifier();
        // puis on modifie la promotion
        $bdd->req('UPDATE eleve SET id_promotion=? WHERE id_compte=?', [
            $this->getPromotion()->getId(),
            $this->getId()
        ]);
    }

    public function creer() {
        // ici on remplace la méthode de Compte à cause du champ promotion supplémentaire
        global $bdd;
        $bdd->req('INSERT INTO compte(nom,  prenom,  centre,  mdp,  nomutilisateur, id_promotion) VALUES(?,?,?,?,?,?)', [
            $this->getNom(),
            $this->getPrenom(),
            $this->getCentre(),
            $this->getMdp(),
            $this->getNomUtilisateur(),
            $this->getPromotion()->getId(),
        ]);
        $this->id = $bdd->dernierId();
        // puis on ajoute la ligne dans la table eleve
        $bdd->req('INSERT INTO eleve(id_compte) VALUES(?)', [
            $this->getId()
        ]);
    }

    public function __construct($eleveObj = null) {
        // on appelle le constructeur de Compte
        parent::__construct($eleveObj);

        // et on remplit l'attributs en plus avec l'array en paramètre
        if ($eleveObj != null) {
            $this->promotionId = $eleveObj['id_promotion'];
        }
    }
}

class ElevesService extends ServiceBase {
    protected static $table = 'eleve';
    protected static $colonneId = 'id_compte';
    protected static $classe = 'Eleve';
    protected static $requeteGet = 'SELECT * FROM eleve INNER JOIN compte ON eleve.id_compte = compte.id_compte WHERE compte.{cle} = ?';


    public static function getByUsername($nomUtilisateur) {
        return self::getOneBy('nomUtilisateur', $nomUtilisateur);
    }
}