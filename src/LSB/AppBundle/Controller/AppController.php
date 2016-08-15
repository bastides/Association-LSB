<?php

namespace LSB\AppBundle\Controller;

use LSB\AppBundle\Entity\BoardGame;
use LSB\AppBundle\Entity\Warhammer40k;
use LSB\AppBundle\Entity\WarhammerBattle;
use LSB\AppBundle\Form\BoardGameType;
use LSB\AppBundle\Form\Warhammer40kType;
use LSB\AppBundle\Form\WarhammerBattleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LSB\AppBundle\Entity\MeetingDate;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

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
        $em = $this->getDoctrine()->getManager();
        $meetingDate = $em->getRepository('LSBAppBundle:MeetingDate')->findOneBy(array('timestamp' => $timestamp));
        $warhammer40ks = $em->getRepository('LSBAppBundle:Warhammer40k')->findBy(array('meetingDate' => $meetingDate));
        $warhammerBattles = $em->getRepository('LSBAppBundle:WarhammerBattle')->findBy(array('meetingDate' => $meetingDate));
        $boardGames = $em->getRepository('LSBAppBundle:BoardGame')->findBy(array('meetingDate' => $meetingDate));

        $user = $this->getUser();

        return $this->render('LSBAppBundle:App:lobby.html.twig', array(
            'timestamp' => $timestamp,
            'warhammer40ks' => $warhammer40ks,
            'warhammerBattles' => $warhammerBattles,
            'boardGames' => $boardGames,
            'user' =>$user
        ));
    }

    public function warhammer40kCreationAction($timestamp, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammer40k = new Warhammer40k();
        $formW40k = $this->createForm(Warhammer40kType::class, $warhammer40k);

        if ($formW40k->handleRequest($request)->isValid()) {
            $meetingDate = $em->getRepository('LSBAppBundle:MeetingDate')->findOneBy(array('timestamp' => $timestamp));
            $user = $this->getUser();

            $warhammer40k->setMeetingDate($meetingDate);
            $warhammer40k->addUser($user);
            $warhammer40k->setCreator($user);
            $em->persist($warhammer40k);
            $em->flush();

            return $this->redirectToRoute('lsb_app_lobby', array(
                'timestamp' => $timestamp
            ));
        }

        return $this->render('LSBAppBundle:App:creationWarhammer40k.html.twig', array(
            'timestamp' => $timestamp,
            'formW40k' => $formW40k->createView()
        ));
    }

    public function warhammerbattleCreationAction($timestamp, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammerBattle = new WarhammerBattle();
        $formWBattle = $this->createForm(WarhammerBattleType::class, $warhammerBattle);

        if ($formWBattle->handleRequest($request)->isValid()) {
            $meetingDate = $em->getRepository('LSBAppBundle:MeetingDate')->findOneBy(array('timestamp' => $timestamp));
            $user = $this->getUser();

            $warhammerBattle->setMeetingDate($meetingDate);
            $warhammerBattle->addUser($user);
            $warhammerBattle->setCreator($user);
            $em->persist($warhammerBattle);
            $em->flush();

            return $this->redirectToRoute('lsb_app_lobby', array(
                'timestamp' => $timestamp
            ));
        }

        return $this->render('LSBAppBundle:App:creationWarhammerBattle.html.twig', array(
            'timestamp' => $timestamp,
            'formBattle' => $formWBattle->createView()
        ));
    }

    public function boardgameCreationAction($timestamp, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $boardGame = new BoardGame();
        $formBG = $this->createForm(BoardGameType::class, $boardGame);

        if ($formBG->handleRequest($request)->isValid()) {
            $meetingDate = $em->getRepository('LSBAppBundle:MeetingDate')->findOneBy(array('timestamp' => $timestamp));
            $user = $this->getUser();

            $boardGame->setMeetingDate($meetingDate);
            $boardGame->addUser($user);
            $boardGame->setCreator($user);
            $em->persist($boardGame);
            $em->flush();

            return $this->redirectToRoute('lsb_app_lobby', array(
                'timestamp' => $timestamp
            ));
        }

        return $this->render('LSBAppBundle:App:creationBoardGame.html.twig', array(
            'timestamp' => $timestamp,
            'formBG' => $formBG->createView()
        ));
    }
}
