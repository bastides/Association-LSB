<?php

namespace LSB\AppBundle\Date;

class LSBGenerateDates
{
    public function generateDates(\DateTime $lastDate)
    {
        // Timestamp de la dernière date en bdd
        $startDate = $lastDate;
        $timestamp = $startDate->getTimestamp();

        // Timestamp de la date d'aujourd'hui
        $today = new \DateTime('today');
        $timestampToday = $today->getTimestamp();

        // Calcul le nombre de date à mettre dans le tableau calendar
        $nbDate = floor((($timestampToday - $timestamp) / 604800 + 5));

        $calendar = array();

        // 6 jours = 518400
        // 7 jours = 604800
        // 8 jours = 691200

        // Ajoute les dates dans le tableau calendar
        for($i = 0; $i < $nbDate; $i++) {
            // Si la dernière date en bss est un vendredi
            if(date('N', $timestamp) == 6) {
                $nextFriday = date('Y-m-d H:i:s', $timestamp + 518400);
                $calendar[$i] = new \DateTime($nextFriday);
                $timestamp += 518400;
            } else {
                $nextSaturday = date('Y-m-d H:i:s', $timestamp + 691200);
                $calendar[$i] = new \DateTime($nextSaturday);
                $timestamp += 691200;
            }
        }

        return $calendar;
    }
}