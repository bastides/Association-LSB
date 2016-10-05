<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TournamentPageTest extends WebTestCase
{
    public function testTournamentPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/tournoi');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    /*public function testFormTournament()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $client = $this->logIn();
        $crawler = $client->request('GET', '/tournoi');

        $form = $crawler->selectButton('Valider')->form(array(
            'tournament[name]' => 'Exemple 1',
            'tournament[place]' => 'Salle TrucMuche, 17 place de la Liberté 03000 Moulins',
            'tournament[tournamentDate][date][day]' => 20,
            'tournament[tournamentDate][date][month]' => 10,
            'tournament[tournamentDate][date][year]' => 2016,
            'tournament[tournamentDate][time][hour]' => 17,
            'tournament[tournamentDate][time][minute]' => 0,
            'tournament[moreInformation]' => 'Aucune modalité particulière',
        ));
        $client->submit($form);
        $client->followRedirect();

        $this->assertEquals('lsb_app_homepage', $client->getRequest()->attributes->get('_route'));
    }*/

    private function logIn()
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        $firewall = 'main';

        $token = new UsernamePasswordToken('Admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }
}