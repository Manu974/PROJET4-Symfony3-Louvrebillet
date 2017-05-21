<?php
// src/LOUVRE/TicketBundle/CalculPrix/PrixBillet.php

namespace LOUVRE\TicketBundle\CalculPrix;

class PrixBillet
{
    public function prixTotal($nbDeVisiteurs,$daystatus)
    {
        $amount= 0;
        $today= new \Datetime('now', new \DateTimeZone('Europe/Paris'));

        foreach ($nbDeVisiteurs as $visiteur) {
            $dateDeNaissance=$visiteur->getDatedenaissance();
            $tarifReduit=$visiteur->getTarifreduit();
            //$daystatus = $visiteur->getBillet()->getJourneecomplete();

         
            $ageVisiteur= (int) $dateDeNaissance->diff($today)->format('%y');

            if(!$tarifReduit && $daystatus == 'Journée') {

                if($ageVisiteur>=4 && $ageVisiteur<12) {
                    $amount +=800;
                }

                else if ($ageVisiteur>=12 && $ageVisiteur<60) {
                    $amount+=1600;
                }
                else if ($ageVisiteur>=60) {
                    $amount+=1200;
                }
                else if ($ageVisiteur<4) {

                    $amount+=0;
                }

            }

         if(!$tarifReduit && $daystatus =='Demi-journée') {

                if($ageVisiteur>=4 && $ageVisiteur<12) {
                    $amount +=600;
                }

                else if ($ageVisiteur>=12 && $ageVisiteur<60) {
                    $amount+=1400;
                }
                else if ($ageVisiteur>=60) {
                    $amount+=1100;
                }
                else if ($ageVisiteur<4) {

                    $amount+=0;
                }

            }

         if($tarifReduit && $daystatus == 'Journée') {

                if($ageVisiteur>=4 && $ageVisiteur<12) {
                    $amount +=800;
                }

                else if ($ageVisiteur>=12 && $ageVisiteur<60) {
                    $amount+=1000;
                }
                else if ($ageVisiteur>=60) {
                    $amount+=1000;
                }
                else if ($ageVisiteur<4) {

                    $amount+=0;
                }

            }

         if($tarifReduit && $daystatus == 'Demi-journée') {

                if($ageVisiteur>=4 && $ageVisiteur<12) {
                    $amount +=600;
                }

                else if ($ageVisiteur>=12 && $ageVisiteur<60) {
                    $amount+=1000;
                }
                else if ($ageVisiteur>=60) {
                    $amount+=1000;
                }
                else if ($ageVisiteur<4) {

                    $amount+=0;
                }

            }
                  
        }
      
        return $amount;
    }

}
