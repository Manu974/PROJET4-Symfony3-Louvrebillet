<?php

// src/LOUVRE/TicketBundle/GenerationCode/Generation.php
namespace LOUVRE\TicketBundle\GenerationCode;

class Generation
{

    public function codeReservation()
    {
        $characts    = 'abcdefghijklmnopqrstuvwxyz';
        $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
        $characts   .= '1234567890'; 
        $code_aleatoire      = ''; 

        for($i=0;$i < 8;$i++)    //8 est le nombre de caractères
        { 
            $code_aleatoire .= substr($characts, rand()%(strlen($characts)), 1); 
        }

        return $code_aleatoire; 

    }
}
    
