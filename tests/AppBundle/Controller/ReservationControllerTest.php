<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function test_page_reservation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservation');

        $this->assertContains('MUSEE DU LOUVRE', $client->getResponse()->getContent());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }
}
