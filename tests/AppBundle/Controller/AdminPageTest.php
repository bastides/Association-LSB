<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminPageTest extends WebTestCase
{
    public function testAdminPage()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin');

        $this->assertEquals('ZONE ADMIN', $crawler->filter('p')->text());
        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $link = $crawler->selectLink('Administration')->link();
        $client->click($link);

        $this->assertEquals('/admin', $client->getRequest()->getPathInfo());
    }

    public function testUserManagementPage()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin/gestion-des-utilisateurs');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());

        $link = $crawler->selectLink('Gestion des utilisateurs')->link();
        $client->click($link);

        $this->assertEquals('/admin/gestion-des-utilisateurs', $client->getRequest()->getPathInfo());
    }

    public function testReturnHomeLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/admin/gestion-des-utilisateurs');
        $link = $crawler->selectLink('Retour au site')->link();
        $client->click($link);

        $this->assertEquals('/', $client->getRequest()->getPathInfo());
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