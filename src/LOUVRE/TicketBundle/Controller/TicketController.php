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
            

            
            /*var_dump(count($limitBillet));
            die();*/
            $em->persist($billet);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            
        }
        
        return $this->render('LOUVRETicketBundle:Ticket:form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
}