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

        $amount= 0;
        $today= new \Datetime('now', new \DateTimeZone('Europe/Paris'));
        
        
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('LOUVRETicketBundle:Billet');

        $billet= $repository->find($id);
        //$NombreVisiteurs=$billet->getVisiteurs();
        

        foreach ($billet->getVisiteurs() as $visiteur) {
            $dateDeNaissance=$visiteur->getDatedenaissance();
            $tarifReduit=$visiteur->getTarifreduit();
        
            $ageVisiteur= (int) $dateDeNaissance->diff($today)->format('%y');
          
            if($ageVisiteur>4 && $ageVisiteur<=12) {
                $amount+=800;
            }
            else if ($ageVisiteur>12 && $ageVisiteur<60) {
                $amount+=1600;
            }

            else if ($ageVisiteur>60) {
                $amount+=1200;
            }

            else if ($ageVisiteur<4) {

                $amount+=0;
            }

            else if ($tarifReduit && $ageVisiteur>17) {

                $amount+=1000;
            }          
        }

        
        if ($request->isMethod('POST')) {
            \Stripe\Stripe::setApiKey("sk_test_H1AamoySDGAPi7KD6CviYFXp");

            // Get the credit card details submitted by the form
            $token = $_POST['token'];
            // Create a charge: this will charge the user's card
            try {
                $charge = \Stripe\Charge::create(
                    array(
                    "amount" => $amount, // Amount in cents
                    "currency" => "eur",
                    "source" => $token,
                    "description" => "Example charge"
                    )
                );

            } catch(\Stripe\Error\Card $e) {
                // The card has been declined
            }

            $request->getSession()->getFlashBag()->add('notice', 'Paypement effetué');
        }

            
        return $this->render(
            'LOUVRETicketBundle:Commande:payement.html.twig', [
            'amount' => $amount,
            ]
        );
    }

}