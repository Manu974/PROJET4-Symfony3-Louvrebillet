<?php
// src/LOUVRE/TicketBundle/Validator/SansVisiteurValidator.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class SansVisiteurValidator extends ConstraintValidator
{
  public function validate($value, Constraint $constraint)
  {
      
      if(count($value)===0)
      {
      	$this->context->addViolation($constraint->messageSansVisiteur); 
      }
  }
}