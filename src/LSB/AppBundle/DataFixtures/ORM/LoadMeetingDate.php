<?php

namespace LSB\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use LSB\AppBundle\Entity\MeetingDate;

class LoadMeetingDate implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $meetingDate1 = new MeetingDate();
        $date = new \DateTime('2016-06-18');
        $timestamp = $date->getTimestamp();
        $meetingDate1->setDate($date);
        $meetingDate1->setTimestamp($timestamp);
        $manager->persist($meetingDate1);


        $manager->flush();

    }
}
