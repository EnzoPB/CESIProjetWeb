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

    public function __construct($tuteurObj = null) {
        // on remplit les attributs avec l'array en paramètre
        if ($tuteurObj != null) {
            $this->id = $tuteurObj['id_compte'];
            $this->nom = $tuteurObj['nom'];
            $this->prenom = $tuteurObj['prenom'];
            $this->centre = $tuteurObj['centre'];
            $this->mdp = $tuteurObj['mdp'];
            $this->nomUtilisateur = $tuteurObj['nomutilisateur'];
        }
    }

}