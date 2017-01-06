<?php

namespace LOUVRE\TicketBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testReservation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservation');

        $this->assertContains('Musee Louvre', $client->getResponse()->getContent());
    }
}
