<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaiementControllerTest extends WebTestCase
{
    public function test_page_commande()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/commande/3');

        $this->assertContains('Reservation pour', $client->getResponse()->getContent());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
