<?php

namespace LSB\AppBundle\Twig;

class DateFrExtension extends \Twig_Extension {

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('fr', array($this, 'dateFr'))
        );
    }

    public function dateFr($date)
    {
        $days = array('', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $months = array('', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        $dateFr = $days[date('N', $date)] . ' ' . date('d', $date) . ' ' . $months[date('n', $date)];

        return $dateFr;
    }

    public function getName()
    {
        return 'LSBDateFr_TwigExtension';
    }
}