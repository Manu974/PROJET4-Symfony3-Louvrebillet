<?php

// src/LOUVRE/TicketBundle/GenerationCode/Generation.php
namespace LOUVRE\TicketBundle\GenerationCode;

class Generation
{
    const NOMBRE_CARACTERE = 8;
    const CARACTERES_POSSIBLES ='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    public function codeReservation()
    {
        $codeAleatoire = ''; 

        for($i=0;$i < self::NOMBRE_CARACTERE;$i++)
        { 
            $codeAleatoire .= substr(self::CARACTERES_POSSIBLES, rand()%(strlen(self::CARACTERES_POSSIBLES)), 1); 
        }
        
        return $codeAleatoire;
    }
}
    
