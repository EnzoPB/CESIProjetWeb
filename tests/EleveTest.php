<?php
use PHPUnit\Framework\TestCase;
include_once('models/eleve.php');
include_once('models/promotion.php');

final class EleveTest extends TestCase
{

    public function creerEleve() {
        $eleve = new Eleve;
        $eleve->setNom('TESTeleve');
        $eleve->setPrenom('TESTeleve');
        $eleve->setNomUtilisateur('TESTeleve');
        $eleve->setMdp('TESTeleve');
        $eleve->setCentre('TESTeleve');
        $promo = PromotionsService::getById(1);
        $eleve->setPromotion($promo);
        $eleve->creer();
        return $eleve;
    }

    public function supprimerEleve($eleve) {
        global $bdd;
        $bdd->req('DELETE FROM eleve WHERE id_compte=?', [
            $eleve->getId()
        ]);
        $bdd->req('DELETE FROM compte WHERE id_compte=?', [
            $eleve->getId()
        ]);
    }

    public function testCreationEleve() {
        $eleve = $this->creerEleve();

        $getEleve = ElevesService::getById($eleve->getId());

        $this->assertEquals($eleve, $getEleve);

        $this->supprimerEleve($eleve);
    }

    public function testModificationEleve() {
        $eleve = $this->creerEleve();

        $eleve->setNom('123');
        $eleve->setPrenom('123');
        $eleve->setNomUtilisateur('123');
        $eleve->setMdp('123');
        $eleve->setCentre('123');
        $promo = PromotionsService::getById(2);
        $eleve->setPromotion($promo);
        $eleve->modifier();

        $getEleve = ElevesService::getById($eleve->getId());

        $this->assertEquals($getEleve->getNom(), '123');
        $this->assertEquals($getEleve->getPrenom(), '123');
        $this->assertEquals($getEleve->getNomUtilisateur(), '123');
        $this->assertEquals($getEleve->getMdp(), '123');
        $this->assertEquals($getEleve->getCentre(), '123');
        $this->assertEquals($getEleve->getPromotion(), $promo);

        $this->supprimerEleve($eleve);
    }

}
