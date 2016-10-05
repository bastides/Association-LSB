<?php

namespace LSB\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class ManagementTournamentController extends Controller
{
    public function deleteTournamentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $tournament = $em->getRepository('LSBAppBundle:Tournament')->find($id);
        if (!$tournament) { throw new Exception("Ce tournoi n'existe pas !"); }

        $em->remove($tournament);
        $em->flush();

        return $this->redirectToRoute('lsb_app_homepage');
    }
}