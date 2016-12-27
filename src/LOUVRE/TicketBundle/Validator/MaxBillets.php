<?php
// src/LOUVRE/TicketBundle/Validator/MaxBillets.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MaxBillets extends Constraint
{
    public $messageMaxBillets = "Vous ne pouvez plus commander, le musée est complet pour cette date";

    public function validatedBy()
    {
        return 'louvre_ticket_maxbillet'; // Ici, on fait appel à l'alias du service
    }
}
