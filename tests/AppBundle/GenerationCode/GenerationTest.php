<?php

namespace Tests\AppBundle\GenerationCode;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use LOUVRE\TicketBundle\GenerationCode\Generation;

class GenerationTest extends WebTestCase
{
	public function test_aleatoire_code()
	{
		$codeDeReservation = new Generation();
		$codeDeReservation2 = new Generation();

		$this->assertNotSame($codeDeReservation,$codeDeReservation2);
	}


}