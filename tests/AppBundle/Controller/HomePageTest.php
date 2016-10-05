<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class HomePageTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testForumLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('FORUM')->link();
        $client->click($link);

        $this->assertEquals('http://seigneur-bourbonnais.activebb.net/', $client->getRequest()->getUri());
    }

    public function testAdminLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('ADMIN')->link();
        $client->click($link);

        $this->assertEquals('/admin/gestion-des-utilisateurs', $client->getRequest()->getPathInfo());
    }

    public function testTournamentLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('CRÉER UN TOURNOI')->link();
        $client->click($link);

        $this->assertEquals('/tournoi', $client->getRequest()->getPathInfo());
    }

    public function testDisconnectionLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('SE DÉCONNECTER')->link();
        $client->click($link);

        $this->assertEquals('/logout', $client->getRequest()->getPathInfo());
    }

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
