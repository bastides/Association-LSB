<?php

namespace LSB\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class ManagementGameController extends Controller
{
    public function joinWarhammer40kAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammer40k = $em->getRepository('LSBAppBundle:Warhammer40k')->find($id);
        if (!$warhammer40k) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $warhammer40k->addUser($user);
        $em->persist($warhammer40k);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function leaveWarhammer40kAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammer40k = $em->getRepository('LSBAppBundle:Warhammer40k')->find($id);
        if (!$warhammer40k) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $warhammer40k->removeUser($user);
        $em->persist($warhammer40k);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function deleteWarhammer40kAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammer40k = $em->getRepository('LSBAppBundle:Warhammer40k')->find($id);
        if (!$warhammer40k) { throw new Exception("Cette partie n'existe pas !"); }

        $em->remove($warhammer40k);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function joinWarhammerbattleAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammerBattle = $em->getRepository('LSBAppBundle:WarhammerBattle')->find($id);
        if (!$warhammerBattle) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $warhammerBattle->addUser($user);
        $em->persist($warhammerBattle);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function leaveWarhammerbattleAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammerBattle = $em->getRepository('LSBAppBundle:WarhammerBattle')->find($id);
        if (!$warhammerBattle) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $warhammerBattle->removeUser($user);
        $em->persist($warhammerBattle);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function deleteWarhammerbattleAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $warhammerBattle = $em->getRepository('LSBAppBundle:WarhammerBattle')->find($id);
        if (!$warhammerBattle) { throw new Exception("Cette partie n'existe pas !"); }

        $em->remove($warhammerBattle);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function joinBoardgameAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $boardGame = $em->getRepository('LSBAppBundle:BoardGame')->find($id);
        if (!$boardGame) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $boardGame->addUser($user);
        $em->persist($boardGame);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function leaveBoardgameAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $boardGame = $em->getRepository('LSBAppBundle:BoardGame')->find($id);
        if (!$boardGame) { throw new Exception("Cette partie n'existe pas !"); }

        $user = $this->getUser();
        $boardGame->removeUser($user);
        $em->persist($boardGame);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }

    public function deleteBoardgameAction($timestamp, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $boardGame = $em->getRepository('LSBAppBundle:BoardGame')->find($id);
        if (!$boardGame) { throw new Exception("Cette partie n'existe pas !"); }

        $em->remove($boardGame);
        $em->flush();

        return $this->redirectToRoute('lsb_app_lobby', array(
            'timestamp' => $timestamp
        ));
    }
}
