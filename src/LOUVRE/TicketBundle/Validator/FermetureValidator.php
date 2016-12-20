<?php
// src/LOUVRE/TicketBundle/Validator/FermetureValidator.php

namespace LOUVRE\TicketBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class FermetureValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
    
        $currentDate=$value->getTimestamp();
        
         if($this->isFerie($currentDate))
        {
             $this->context->addViolation($constraint->messageJourFeries);
        }

        if($this->isSunday($currentDate))
        {
            $this->context->addViolation($constraint->messageDimanches);
        }

        if($this->isTuesday($currentDate))
        {
            $this->context->addViolation($constraint->messageMardis);
        }
        
    }

    private function getJourFeries($year)
    {
        if ($year === null) {
            $year = intval(strftime('%Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);

        $holidays = [
            // Jours feries fixes
            mktime(0, 0, 0, 1, 1, $year),// 1er janvier
            mktime(0, 0, 0, 5, 1, $year),// Fete du travail
            mktime(0, 0, 0, 5, 8, $year),// Victoire des allies
            mktime(0, 0, 0, 7, 14, $year),// Fete nationale
            mktime(0, 0, 0, 8, 15, $year),// Assomption
            mktime(0, 0, 0, 11, 1, $year),// Toussaint
            mktime(0, 0, 0, 11, 11, $year),// Armistice
            mktime(0, 0, 0, 12, 25, $year),// Noel

            // Jour feries qui dependent de paques
            mktime(0, 0, 0, $easterMonth, $easterDay + 2, $easterYear),// Lundi de paques ( paques toujous un dimanche)
            mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear),// Ascension
            mktime(0, 0, 0, $easterMonth, $easterDay + 51, $easterYear), // Lundi de Pentecote ( pentecote tombe toujours un dimanche)
        ];

        sort($holidays);

        return $holidays;
    }
    
    private function isFerie($timestamp)
    {
        
        $iYear = strftime('%Y', $timestamp);

        $aHolidays = $this->getJourFeries($iYear);
        /*
        * On est oblige de convertir les timestamps en string a cause des decalages horaires.
        */
        $aHolidaysString = array_map(function ($value) {
            return strftime('%Y-%m-%d', $value);
        }, $aHolidays);

        return in_array(strftime('%Y-%m-%d', $timestamp), $aHolidaysString);
    }

    private function isSunday($timestamp)
    {
        $jourDimanche=strftime('%A', $timestamp);

        return $jourDimanche === 'Sunday';
    }

    private function isTuesday($timestamp)
    {
        $jourMardi=strftime('%A', $timestamp);

        return $jourMardi === 'Tuesday';
    }
}