<?php

namespace LSB\AppBundle\Repository;

/**
 * TournamentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournamentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByDate()
    {
        $qb = $this->createQueryBuilder('t');
        $qb
            ->where('t.tournamentDate > :now')
            ->setParameter('now', new \DateTime('now'))
            ->orderBy('t.tournamentDate')
        ;
        return $qb->getQuery()->getResult();
    }
}