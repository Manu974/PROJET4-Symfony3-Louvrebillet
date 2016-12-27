<?php
// src/LOUVRE/TicketBundle/Validator/DemijourneeValidator.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DemijourneeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {

        $today= new \Datetime('now', new \DateTimeZone('Europe/Paris'));
        $dateToday=$today->format('H:i');

        if($value ==='Journée' && $dateToday >'14:00') {
            $this->context->addViolation($constraint->messageBilletDemiJournee);        
        }  
    }
}
