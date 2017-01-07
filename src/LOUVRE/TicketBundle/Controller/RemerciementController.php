<?php

// src/LOUVRE/TicketBundle/Controller/RemerciementController.php

namespace LOUVRE\TicketBundle\Controller;

use LOUVRE\TicketBundle\Entity\Billet;
use LOUVRE\TicketBundle\Entity\Visiteur;
use LOUVRE\TicketBundle\Form\BilletType;
use LOUVRE\TicketBundle\Form\VisiteurType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RemerciementController extends Controller
{

    public function thanksAction()
    {
        return $this->render('LOUVRETicketBundle:Ticket:remerciement.html.twig');
    }
}
