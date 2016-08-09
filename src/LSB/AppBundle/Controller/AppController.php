<?php

namespace LSB\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LSB\AppBundle\Entity\MeetingDate;

class AppController extends Controller
{
    public function indexAction()
    {
        // CREATING AND SAVING DATES
        $em = $this->getDoctrine()->getManager();
        $lastInsertion = $em->getRepository('LSBAppBundle:MeetingDate')->findBy(array(), array('id' => 'desc'),1,0);
        $lastDate = $lastInsertion[0]->getDate();

        $dates = $this->get('lsb_app.generatedates')->generateDates($lastDate);

        if (isset($dates[0])) {
            $arrayLastDate = $dates[count($dates) - 1]->getTimestamp();

            $today = new \DateTime('today');
            $todayFourWeeksLater = $today->getTimestamp() + (604800 * 6);

            if ($arrayLastDate < $todayFourWeeksLater) {
                foreach ($dates as $date) {
                    $newDate = new MeetingDate();
                    $newDate->setDate($date);
                    $timestamp = $date->getTimestamp();
                    $newDate->setTimestamp($timestamp);
                    $em->persist($newDate);
                }
                $em->flush();
            }
        }

        // GET AND SORTING DATES
        $homeDates = $em->getRepository('LSBAppBundle:MeetingDate')->findBy(array(), array('id' => 'desc'),9,0);
        $sortedDates = array();
        $j = 0;

        for ($i = count($homeDates) - 1; $i >= 0; $i--) {
            $sortedDates[$j] = $homeDates[$i];
            $j ++;
        }

        return $this->render('LSBAppBundle:App:index.html.twig', array(
            'dates' => $sortedDates
        ));
    }

    public function lobbyAction($timestamp)
    {
        return $this->render('LSBAppBundle:App:lobby.html.twig');
    }
}
