<?php
include_once('models/tuteur.php');
include_once('models/eleve.php');
include_once('inc/helpers/formulaire.php');
include_once('inc/helpers/url.php');

// on redirige l'utilisateur vers l'accueil s'il est déjà connecté
if ($session->estConnecte) {
    rediriger('/');
}

$verificationsOk = false;

if ($_POST) {
    // on effectue les vérifications sur les entrées (type, requit, taille max)
    $verifications = [
        'nomUtilisateur' => verifier_entree('nomUtilisateur', 'string', true, 50),
        'motDePasse' => verifier_entree('motDePasse', 'string', true, 50),
        'typeCompte' => verifier_entree('typeCompte', 'string', true)
    ];
    
    // si ces vérifications sont ok
    if (
        $verifications['nomUtilisateur'] &&
        $verifications['motDePasse'] &&
        $verifications['typeCompte']
    ) {
        $verificationsOk = true;
        // on récupère les informations du compte en fonction
        if ($_POST['typeCompte'] == 'tuteur') {
            $compte = TuteursService::getByUsername($_POST['nomUtilisateur']);
        } else {
            $compte = ElevesService::getByUsername($_POST['nomUtilisateur']);
        }

        // si on trouve bien un compte dans la bdd, et que le mdp entré correspond bien à celui du compte
        if ($compte != null && password_verify($_POST['motDePasse'], $compte->getMdp())) {
            // alors la connexion est ok, on connecte l'utilisateur dans la session
            $session->connecter($compte);
            // et on redirige
            rediriger('/');
        }
    }
}
?>

<form method="post">
    <?php if ($_POST): // si le formulaire et envoyé et que les vérifications sont ok, ca veut dire que l'authentification a échoué ?>
        Le nom d'utilisateur ou le mot de passe est incorrect
    <?php endif; ?>

    <?php if ($_POST && !$verifications['typeCompte']): ?>
        Le type de compte ne respecte pas le format requit
    <?php endif; ?>
    <select name="typeCompte">
        <option value="tuteur">Tuteur</option>
        <option value="eleve">Élève</option>
    </select>

    <?php if ($_POST && !$verifications['nomUtilisateur']): ?>
        Le nom d'utilisateur ne respecte pas le format requit
    <?php endif; ?>
    <input type="text" name="nomUtilisateur">

    <?php if ($_POST && !$verifications['motDePasse']): ?>
        Le mot de passe ne respecte pas le format requit
    <?php endif; ?>
    <input type="password" name="motDePasse">
    <input type="submit">
</form>
