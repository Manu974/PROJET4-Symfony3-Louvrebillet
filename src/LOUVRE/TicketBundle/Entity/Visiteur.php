<?php

namespace LOUVRE\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Visiteur
 *
 * @ORM\Table(name="visiteur")
 * @ORM\Entity(repositoryClass="LOUVRE\TicketBundle\Repository\VisiteurRepository")
 */
class Visiteur
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedenaissance", type="date")
     */
    private $datedenaissance;

    /**
     * @var bool
     *
     * @ORM\Column(name="tarifreduit", type="boolean")
     */
    private $tarifreduit;

    
    
    /**
    * @ORM\ManytoOne(targetEntity="LOUVRE\TicketBundle\Entity\Billet", inversedBy="visiteurs")
    * @ORM\JoinColumn(nullable=false)
    */
    private $billet;
    

    
  
    public function __construct()
    {
        $this->date         = new \Datetime();
        
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Visiteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Visiteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Visiteur
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set datedenaissance
     *
     * @param \DateTime $datedenaissance
     *
     * @return Visiteur
     */
    public function setDatedenaissance($datedenaissance)
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    /**
     * Get datedenaissance
     *
     * @return \DateTime
     */
    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    /**
     * Set tarifreduit
     *
     * @param boolean $tarifreduit
     *
     * @return Visiteur
     */
    public function setTarifreduit($tarifreduit)
    {
        $this->tarifreduit = $tarifreduit;

        return $this;
    }

    /**
     * Get tarifreduit
     *
     * @return boolean
     */
    public function getTarifreduit()
    {
        return $this->tarifreduit;
    }

    /**
     * Set billet
     *
     * @param \LOUVRE\TicketBundle\Entity\Billet $billet
     *
     * @return Visiteur
     */
    public function setBillet(\LOUVRE\TicketBundle\Entity\Billet $billet)
    {
        $this->billet = $billet;

        return $this;
    }

    /**
     * Get billet
     *
     * @return \LOUVRE\TicketBundle\Entity\Billet
     */
    public function getBillet()
    {
        return $this->billet;
    }
}
