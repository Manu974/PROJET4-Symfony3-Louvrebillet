<?php

namespace LOUVRE\TicketBundle\Tests\CalculPrix;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PrixBilletTest extends WebTestCase
{
    public function test_prix_enfant()
    {
        $prixBillet = new PrixBillet();
        $result = $prixBillet->prixTotal(1);

       
        
    }

}
