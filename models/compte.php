<?php

class Compte {
    private $id;
    private $nom;
    private $prenom;
    private $centre;
    private $mdp;
    private $nomUtilisateur;

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getCentre() {
        return $this->centre;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getNomUtilisateur() {
        return $this->nomUtilisateur;
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