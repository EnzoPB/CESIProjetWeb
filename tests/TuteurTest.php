<?php
use PHPUnit\Framework\TestCase;
include_once('models/tuteur.php');

final class TuteurTest extends TestCase
{

    public function creerTuteur() {
        $tuteur = new Tuteur;
        $tuteur->setNom('TESTtuteur');
        $tuteur->setPrenom('TESTtuteur');
        $tuteur->setNomUtilisateur('TESTtuteur');
        $tuteur->setMdp('TESTtuteur');
        $tuteur->setCentre('TESTtuteur');
        $tuteur->creer();
        return $tuteur;
    }

    public function supprimerTuteur($tuteur) {
        global $bdd;
        $bdd->req('DELETE FROM tuteur WHERE id_compte=?', [
            $tuteur->getId()
        ]);
        $bdd->req('DELETE FROM compte WHERE id_compte=?', [
            $tuteur->getId()
        ]);
    }

    public function testCreationTuteur() {
        $tuteur = $this->creerTuteur();

        $getTuteur = TuteursService::getById($tuteur->getId());

        $this->assertEquals($tuteur, $getTuteur);

        $this->supprimerTuteur($tuteur);
    }

    public function testModificationTuteur() {
        $tuteur = $this->creerTuteur();

        $tuteur->setNom('123');
        $tuteur->setPrenom('123');
        $tuteur->setNomUtilisateur('123');
        $tuteur->setMdp('123');
        $tuteur->setCentre('123');
        $tuteur->modifier();

        $getTuteur = TuteursService::getById($tuteur->getId());

        $this->assertEquals($getTuteur->getNom(), '123');
        $this->assertEquals($getTuteur->getPrenom(), '123');
        $this->assertEquals($getTuteur->getNomUtilisateur(), '123');
        $this->assertEquals($getTuteur->getMdp(), '123');
        $this->assertEquals($getTuteur->getCentre(), '123');

        $this->supprimerTuteur($tuteur);
    }

}
