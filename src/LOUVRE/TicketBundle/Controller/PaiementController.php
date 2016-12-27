<?php

// src/LOUVRE/TicketBundle/Controller/PaiementController.php

namespace LOUVRE\TicketBundle\Controller;

use LOUVRE\TicketBundle\Entity\Billet;
use LOUVRE\TicketBundle\Entity\Visiteur;
use LOUVRE\TicketBundle\Form\BilletType;
use LOUVRE\TicketBundle\Form\VisiteurType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class PaiementController extends Controller
{
	public function commandeAction($id,Request $request)
    {

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LOUVRETicketBundle:Billet');

        $billet= $repository->find($id);
        
        $prixBillet= $this->container->get('louvre_ticket.prixbillet')->prixTotal($billet->getVisiteurs());
        
        if ($request->isMethod('POST')) {
            \Stripe\Stripe::setApiKey("sk_test_H1AamoySDGAPi7KD6CviYFXp");

            // Get the credit card details submitted by the form
            $token = $_POST['token'];
            // Create a charge: this will charge the user's card
            try {
                $charge = \Stripe\Charge::create(
                    array(
                    "amount" => $prixBillet, // Amount in cents
                    "currency" => "eur",
                    "source" => $token,
                    "description" => "Example charge"
                    )
                );

            } catch(\Stripe\Error\Card $e) {
                // The card has been declined
            }

        $request->getSession()->getFlashBag()->add('notice', 'Paypement effetué, vous recevrez dans quelqueminutes un mail de confirmation!');
            //return $this->render('LOUVRETicketBundle:Ticket:index.html.twig');
        }

            
        return $this->render(
            'LOUVRETicketBundle:Commande:payement.html.twig', [
            'amount' => $prixBillet,
            ]
        );
    }

}