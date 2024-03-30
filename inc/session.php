<?php
include_once('models/eleve.php');
include_once('models/tuteur.php');

class Session {
    public $estConnecte;
    public $utilisateur;
    public $typeCompte;

    public function __construct() {
        session_start();

        $this->estConnecte = false; // on part du principe que l'utilisateur n'est pas connecté
        $this->majUtilisateur(); // on met à jour les informations de l'utilisateur (s'il est connecté)
    }

    public function majUtilisateur() {
        // on regarde s'il y a bien l'id et le type de compte dans $_SESSION (requit pour avoir les informations du compte)
        if (array_key_exists('id', $_SESSION) && array_key_exists('typeCompte', $_SESSION)) {
            // on récupère les information du compte en fonction de son type
            if ($_SESSION['typeCompte'] == 'tuteur') {
                $compte = TuteursService::getById($_SESSION['id']);
            } else {
                $compte = ElevesService::getById($_SESSION['id']);
            }

            // si un compte est bien trouvé, alors on stocke ses informations et on marque la session comme connectée
            if ($compte != null) {
                $this->utilisateur = $compte;
                $this->estConnecte = true;
                $this->typeCompte = $_SESSION['typeCompte'];
            }
        }
    }

    public function connecter($compte) {
        $_SESSION['id'] = $compte->getId();
        // on stocke le type du compte
        if ($compte instanceof Tuteur) {
            $_SESSION['typeCompte'] = 'tuteur';
        } else {
            $_SESSION['typeCompte'] = 'eleve';
        }
        $this->majUtilisateur(); // on met à jour les informations de l'utilisateur
    }

    public function deconnecter() {
        session_destroy(); // on supprime la session
        $this->majUtilisateur(); // on met à jour les informations de l'utilisateur
    }
}