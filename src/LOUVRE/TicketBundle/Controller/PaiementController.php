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
    public function commandeAction($code,Request $request)
    {

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LOUVRETicketBundle:Billet');

        $billet= $repository->findOneBy(['codereservation'=>$code]);
        $statusCommande=$billet->getPaiement();
        
        $prixBillet= $this->container->get('louvre_ticket.prixbillet')->prixTotal($billet->getVisiteurs());
        
        if ($request->isMethod('POST')) {
            \Stripe\Stripe::setApiKey($this->getParameter('cleSecretStripe'));
            // Get the credit card details submitted by the form
            $token = $_POST['token'];
            // Create a charge: this will charge the user's card
            try {
                $charge = \Stripe\Charge::create([
                    "amount" => $prixBillet, // Amount in cents
                    "currency" => "eur",
                    "source" => $token,
                    "description" => "paiement billet"
                ]);

            } 
            catch(\Stripe\Error\Card $e) {
                // The card has been declined
            }

            $request->getSession()->getFlashBag()->add('notice', 'Paiement effetué, vous recevrez dans quelques minutes un mail de confirmation à imprimer en guise de billet!');
        }

        return $this->render(
            'LOUVRETicketBundle:Commande:payement.html.twig', [
            'amount' => $prixBillet,
            'code'=> $code,
            'email'=> $billet->getEmail(),
            'clestripe'=> $this->getParameter('clePublicStripe'),
            'listVisiteurs'=> $billet->getVisiteurs(),
            'datedereservation'=> $billet->getDatedevisite()->format('d-m-Y'),
            'typedebillet'=>$billet->getJourneecomplete(),
            'statusCommande'=>$statusCommande,
        ]);
    }
}
