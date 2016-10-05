<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserManagementTest extends WebTestCase
{
    public function testRegistrationLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('S\'INSCRIRE')->link();
        $client->click($link);

        $this->assertEquals('/register/', $client->getRequest()->getPathInfo());
    }

    public function testConnexionLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $link = $crawler->selectLink('SE CONNECTER')->link();
        $client->click($link);

        $this->assertEquals('/login', $client->getRequest()->getPathInfo());
    }

    public function testFormConnexion()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Connexion')->form(array(
            '_username' => 'admin',
            '_password' => 0000,
        ));
        $client->submit($form);
        $client->followRedirect();

        $this->assertEquals('fos_user_security_login', $client->getRequest()->attributes->get('_route'));
    }

    public function testHomeAfterConnexion()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/');
        $this->assertEquals('PROCHAIN TOURNOI', $crawler->filter('h2')->text());
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