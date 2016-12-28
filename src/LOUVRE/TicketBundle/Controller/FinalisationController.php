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
    	$repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LOUVRETicketBundle:Billet');

        $billet= $repository->find($id);
        $email=$billet->getEmail();

        $listVisiteurs= $billet->getVisiteurs();
        $dateDeResevartion= $billet->getDatedevisite();
        $prixdubillet=$this->container->get('louvre_ticket.prixbillet')->prixTotal($billet->getVisiteurs());
        
        

        $message = \Swift_Message::newInstance()
        ->setSubject('Confirmation de reservation')
        ->setFrom('emmanuel.dijoux16@gmail.com')
        ->setTo($email)
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'LOUVRETicketBundle:Emails:confirmationReservation.html.twig',[
                'listVisiteurs'=>$listVisiteurs,
                'dateDeResevartion'=> $dateDeResevartion->format('d-m-Y'),
                'tarif'=>$prixdubillet/100,

                ]
                
            ),
            'text/html'
        );
        
        $this->get('mailer')->send($message);


    	return $this->redirectToRoute('louvre_ticket_remerciementpage');
        
    }
}

