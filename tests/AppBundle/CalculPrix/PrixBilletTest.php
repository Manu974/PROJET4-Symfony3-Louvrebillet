<?php

namespace Tests\AppBundle\CalculPrix;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use LOUVRE\TicketBundle\Entity\Visiteur;
use LOUVRE\TicketBundle\CalculPrix\PrixBillet;

class PrixBilletTest extends WebTestCase
{
    public function test_prix_pour_tarif_enfant()
    {

        $visiteur = new Visiteur();
        $format = 'Y-m-d';
		$date = \DateTime::createFromFormat($format, '2009-02-15');
        $visiteur->setDatedenaissance($date);

        $PrixBillet = new PrixBillet();

        $result = $PrixBillet->prixTotal([$visiteur]);

        $this->assertEquals(800, $result);
    }

    public function test_prix_pour_tarif_normal()
    {

        $visiteur = new Visiteur();
        $format = 'Y-m-d';
		$date = \DateTime::createFromFormat($format, '2000-02-15');
        $visiteur->setDatedenaissance($date);

        $PrixBillet = new PrixBillet();

        $result = $PrixBillet->prixTotal([$visiteur]);

        $this->assertEquals(1600, $result);
    }

    public function test_prix_pour_tarif_senior()
    {

        $visiteur = new Visiteur();
        $format = 'Y-m-d';
		$date = \DateTime::createFromFormat($format, '1955-02-15');
        $visiteur->setDatedenaissance($date);

        $PrixBillet = new PrixBillet();

        $result = $PrixBillet->prixTotal([$visiteur]);

        $this->assertEquals(1200, $result);
    }

    public function test_prix_pour_tarif_gratuit()
    {

        $visiteur = new Visiteur();
        $format = 'Y-m-d';
		$date = \DateTime::createFromFormat($format, '2016-02-15');
        $visiteur->setDatedenaissance($date);

        $PrixBillet = new PrixBillet();

        $result = $PrixBillet->prixTotal([$visiteur]);

        $this->assertEquals(0, $result);
    }
}