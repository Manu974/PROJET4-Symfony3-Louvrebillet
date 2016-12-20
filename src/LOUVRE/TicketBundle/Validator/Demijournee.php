<?php
// src/LOUVRE/TicketBundle/Validator/Demijournee.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Demijournee extends Constraint
{
    
    public $messageBilletDemiJournee = "Vous ne pouvez plus commander de billet 'Journée' après 14h00";
    
    
}