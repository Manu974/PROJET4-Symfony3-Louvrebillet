<?php

namespace LOUVRE\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use LOUVRE\TicketBundle\Validator\Fermeture;
use LOUVRE\TicketBundle\Validator\JourPasse;
use LOUVRE\TicketBundle\Validator\Demijournee;
use LOUVRE\TicketBundle\Validator\SansVisiteur;
use LOUVRE\TicketBundle\Validator\MaxBillets;
use Symfony\Component\Validator\Context\ExecutionContextInterface;



/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="LOUVRE\TicketBundle\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedevisite", type="datetime")
     * @Fermeture()
     * 
     * @JourPasse()
     * @MaxBillets()
     */
    private $datedevisite;
    

    /**
     * @var string
     *
     * @ORM\Column(name="journeecomplete", type="string", length=255)
     * 
     */
    private $journeecomplete;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    
    /**
     * @ORM\OneToMany(targetEntity="LOUVRE\TicketBundle\Entity\Visiteur",  mappedBy="billet", cascade={"all"})
     * 
     * @SansVisiteur()
     */
    private $visiteurs;


    /**
     * @var string
     *
     * @ORM\Column(name="codereservation", type="string", length=255, nullable=true)
     */
    private $codereservation;

    /**
     * @var bool
     *
     * @ORM\Column(name="paiement", type="boolean", nullable=true)
     */
    private $paiement;
    
    
    /**
    *   @Assert\Callback
    */
    public function isDateValid(ExecutionContextInterface $context)
    {
        $dateSelect = $this->getDatedevisite();
        $dateCompare = new \Datetime('now');

        $dateTodayStart = new \Datetime('now');
        $dateTodayStart->setTime(14,00);
        $dateTodayEnd = new \Datetime('now');
        $dateTodayEnd->setTime(23,00);
        

        $statusJournee = $this->getJourneecomplete();
        if($dateSelect->format('d-m-y') == $dateCompare->format('d-m-y')){
            $dateCurrent= new \Datetime('now', new \DateTimeZone('Europe/Paris'));

            if (($dateCurrent > $dateTodayStart && $dateCurrent<$dateTodayEnd) && $statusJournee=='Journée')
            {
            $context
                ->BuildViolation("Vous ne pouvez plus commander de billet 'Journée' après 14h00")
                ->atPath('journeecomplete')
                ->addViolation();
            }

        }

        
       
        

    }

    public function __construct()
    {
         
        $this->date         =  new \Datetime('now', new \DateTimeZone('Europe/Paris'));
        $this->visiteurs   = new ArrayCollection();
        
    }

    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedevisite
     *
     * @param \DateTime $datedevisite
     *
     * @return Billet
     */
    public function setDatedevisite($datedevisite)
    {
        $this->datedevisite = $datedevisite;

        return $this;
    }

    /**
     * Get datedevisite
     *
     * @return \DateTime
     */
    public function getDatedevisite()
    {
        return $this->datedevisite;
    }

    /**
     * Set journeecomplete
     *
     * @param string $journeecomplete
     *
     * @return Billet
     */
    public function setJourneecomplete($journeecomplete)
    {
        $this->journeecomplete = $journeecomplete;

        return $this;
    }

    /**
     * Get journeecomplete
     *
     * @return string
     */
    public function getJourneecomplete()
    {
        return $this->journeecomplete;
    }

     /**
     * Set email
     *
     * @param string $email
     *
     * @return Visiteur
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add visiteur
     *
     * @param \LOUVRE\TicketBundle\Entity\Visiteur $visiteur
     *
     * @return Billet
     */
    public function addVisiteur(\LOUVRE\TicketBundle\Entity\Visiteur $visiteur)
    {
        $this->visiteurs[] = $visiteur;
        
        $visiteur->setBillet($this);

        return $this;
    }

    /**
     * Remove visiteur
     *
     * @param \LOUVRE\TicketBundle\Entity\Visiteur $visiteur
     */
    public function removeVisiteur(\LOUVRE\TicketBundle\Entity\Visiteur $visiteur)
    {
        $this->visiteurs->removeElement($visiteur);
    }

    /**
     * Get visiteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisiteurs()
    {
        return $this->visiteurs;
    }

 

    /**
     * Set codereservation
     *
     * @param string $codereservation
     *
     * @return Billet
     */
    public function setCodereservation($codereservation)
    {
        $this->codereservation = $codereservation;

        return $this;
    }

    /**
     * Get codereservation
     *
     * @return string
     */
    public function getCodereservation()
    {
        return $this->codereservation;
    }

    /**
     * Set paiement
     *
     * @param boolean $paiement
     *
     * @return Billet
     */
    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * Get paiement
     *
     * @return boolean
     */
    public function getPaiement()
    {
        return $this->paiement;
    }
}
