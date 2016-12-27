<?php
// src/LOUVRE/TicketBundle/Validator/SansVisiteur.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SansVisiteur extends Constraint
{
	public $messageSansVisiteur = "il doit y avoir au moins un visiteur pour le billet";
}