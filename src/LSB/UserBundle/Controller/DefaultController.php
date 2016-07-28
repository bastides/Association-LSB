<?php

namespace LSB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LSBUserBundle:App:index.html.twig');
    }
}
