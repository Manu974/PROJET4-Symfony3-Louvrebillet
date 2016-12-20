<?php
// src/LOUVRE/TicketBundle/Validator/MaxBilletsValidator.php

namespace LOUVRE\TicketBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class MaxBilletsValidator extends ConstraintValidator
{
    const MAX_BILLET = 1000;
    /**
    * @var LOUVRE\TicketBundle\Repository\VisiteurRepository
    */
    private $database;


    public function __construct(EntityManager $em)
    {
        $this->database = $em->getRepository('LOUVRETicketBundle:Visiteur');
    }

    public function validate($dateDeReservation, Constraint $constraint)
    {
        $nombreBillets = $this->database->countVisitorsFor($dateDeReservation);

        if($nombreBillets > self::MAX_BILLET) {
            $this->context->addViolation($constraint->messageMaxBillets);
        }
    }
}