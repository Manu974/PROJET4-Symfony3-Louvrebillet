<?php
// src/LOUVRE/TicketBundle/Validator/JourPasse.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class JourPasse extends Constraint
{
	public $message = "Vous ne pouvez pas commander pour les jours passés ";
}