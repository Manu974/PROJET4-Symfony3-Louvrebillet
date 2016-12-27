<?php

// src/LOUVRE/TicketBundle/Controller/TicketController.php

namespace LOUVRE\TicketBundle\Controller;

use LOUVRE\TicketBundle\Entity\Billet;
use LOUVRE\TicketBundle\Entity\Visiteur;
use LOUVRE\TicketBundle\Form\BilletType;
use LOUVRE\TicketBundle\Form\VisiteurType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Doctrine\ORM\QueryBuilder;


class TicketController extends Controller
{
    public function reservationAction(Request $request)
    {
    
        
        $billet= new Billet();
        $billet->setDatedevisite(new \Datetime('now', new \DateTimeZone('Europe/Paris')));//prérempli le champs date de visite avec la date d'aujourd'hui
      
        $form = $this->get('form.factory')->create(BilletType::class, $billet);
        
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) { 

            $em = $this->getDoctrine()->getManager();
            $em->persist($billet);
            $em->flush();
              
            return $this->redirectToRoute('louvre_ticket_commandepage', array('id'=>$billet->getId()));
                        
        }
        
        return $this->render(
            'LOUVRETicketBundle:Ticket:form.html.twig', [
            'form' => $form->createView(),
            ]
        );
    }

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
                    "currency" => "usd",
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

    public function achatAction()
    {
        return $this->render('LOUVRETicketBundle:Ticket:index.html.twig');
    }
    
}
