<?php

// src/LOUVRE/TicketBundle/MailConfirmation/Mail.php
namespace LOUVRE\TicketBundle\MailConfirmation;

use Doctrine\ORM\EntityManager;

class Mail
{
    protected $twig;
    protected $mailer;

    public function __construct(EntityManager $em,$prixbillet,$codereservation,\Twig_Environment $twig,\Swift_Mailer $mailer)
    {
        $this->database = $em->getRepository('LOUVRETicketBundle:Billet');
        $this->prixbillet= $prixbillet;
        $this->codereservation= $codereservation;
        $this->twig = $twig;
        $this->mailer = $mailer;
        
    }

    public function envoi_mail_confirmation($id)
    {
        $billet= $this->database->find($id);
        $email=$billet->getEmail();
        $listVisiteurs= $billet->getVisiteurs();
        $dateDeResevartion= $billet->getDatedevisite();
        $prixdubillet=$this->prixbillet->prixTotal($billet->getVisiteurs());
        $codereservation=$this->codereservation->codeReservation();
        
        
        $message = \Swift_Message::newInstance();
        $logoLouvre= $message->embed(\Swift_Image::fromPath('../web/bundles/louvreticket/images/logo_louvre.png'));
        
        $message->setSubject('Confirmation de reservation')
            ->setFrom('emmanuel.dijoux16@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->twig->render(
                    // app/Resources/views/Emails/registration.html.twig
                    'LOUVRETicketBundle:Emails:confirmationReservation.html.twig', [
                    'listVisiteurs'=>$listVisiteurs,
                    'dateDeResevartion'=> $dateDeResevartion->format('d-m-Y'),
                    'tarif'=>$prixdubillet/100,
                    'codeReservation'=>$codereservation,
                    'urlImage'=>$logoLouvre,

                    ]
                ),
                'text/html'
            );
        
        $this->mailer->send($message);

    }
}
