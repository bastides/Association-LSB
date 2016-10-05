<?php

namespace Tests\AppBundle\Controller;

use LSB\AppBundle\Twig\DateFrExtension;

class DatesTest extends \PHPUnit_Framework_TestCase
{
    public function testDateFr()
    {
        $dateFr = new DateFrExtension();
        $date = new \DateTime('2016-09-26');
        $timestamp = $date->getTimestamp();

        $this->assertEquals('Lundi 26 Septembre', $dateFr->dateFr($timestamp));
    }
}