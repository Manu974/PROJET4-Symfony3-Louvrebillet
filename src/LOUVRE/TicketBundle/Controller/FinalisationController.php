<?php

// src/LOUVRE/TicketBundle/Controller/FinalisationController.php

namespace LOUVRE\TicketBundle\Controller;

use LOUVRE\TicketBundle\Entity\Billet;
use LOUVRE\TicketBundle\Entity\Visiteur;
use LOUVRE\TicketBundle\Form\BilletType;
use LOUVRE\TicketBundle\Form\VisiteurType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FinalisationController extends Controller
{
    public function mailAction($id,Request $request)
    {
        

        $this->container->get('louvre_ticket.maildeconfirmation')->envoi_mail_confirmation($id);


        return $this->redirectToRoute('louvre_ticket_remerciementpage');
        
    }
}

