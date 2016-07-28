<?php

namespace LSB\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    public function indexAction()
    {
        return $this->render('LSBAppBundle:App:index.html.twig');
    }
}
