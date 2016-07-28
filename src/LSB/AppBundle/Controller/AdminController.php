<?php

namespace LSB\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('LSBAppBundle:Admin:index.html.twig');
    }
}
