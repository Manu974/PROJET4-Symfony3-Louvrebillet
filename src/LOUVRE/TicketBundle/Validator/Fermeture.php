<?php
// src/LOUVRE/TicketBundle/Validator/Fermeture.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Fermeture extends Constraint
{

    public $messageJourFeries = "le musée est fermé les jours fériés";
    public $messageDimanches = "le musée est fermé les Dimanches";
    public $messageMardis = "le musée est fermé les Mardis";

}
