<?php
// src/LOUVRE/TicketBundle/Validator/JourPasseValidator.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class JourPasseValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
	{
		$todayMidnight = strtotime('today midnight');
		$valeurJourVisite = $value->getTimestamp();

		if($valeurJourVisite < $todayMidnight) {
			$this->context->addViolation($constraint->message);        
		}  
	}
}