<?php

class Compte {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $centre;
    protected $mdp;
    protected $nomUtilisateur;

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getCentre() {
        return $this->centre;
    }
    public function setCentre($centre) {
        $this->centre = $centre;
    }

    public function getMdp() {
        return $this->mdp;
    }
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    public function getNomUtilisateur() {
        return $this->nomUtilisateur;
    }
    public function setNomUtilisateur($nomUtilisateur) {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    public function modifier() {
        global $bdd;
        $bdd->req('UPDATE compte SET nom=?, prenom=?, centre=?, mdp=?, nomutilisateur=? WHERE id_compte=?', [
            $this->getNom(),
            $this->getPrenom(),
            $this->getCentre(),
            $this->getMdp(),
            $this->getNomUtilisateur(),
            $this->getId()
        ]);
    }

    public function creer() {
        global $bdd;
        $bdd->req('INSERT INTO compte(nom,  prenom,  centre,  mdp,  nomutilisateur) VALUES(?,?,?,?,?)', [
            $this->getNom(),
            $this->getPrenom(),
            $this->getCentre(),
            $this->getMdp(),
            $this->getNomUtilisateur()
        ]);
        $this->id = $bdd->dernierId();
    }

    public function __construct($compteObj = null) {
        // on remplit les attributs avec l'array en paramètre
        if ($compteObj != null) {
            $this->id = $compteObj['id_compte'];
            $this->nom = $compteObj['nom'];
            $this->prenom = $compteObj['prenom'];
            $this->centre = $compteObj['centre'];
            $this->mdp = $compteObj['mdp'];
            $this->nomUtilisateur = $compteObj['nomutilisateur'];
        }
    }

}