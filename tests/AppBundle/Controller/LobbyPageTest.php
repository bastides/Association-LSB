<?php

namespace Tests\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class LobbyPageTest extends WebTestCase
{
    public function testLobbyPage()
    {
        $client = $this->logIn();
        $client->request('GET', '/salon/1478304000');

        $this->assertTrue(200 === $client->getResponse()->getStatusCode());
    }

    public function testWarhammer40kLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/1478304000');
        $link = $crawler->selectLink('WARHAMMER 40K')->link();
        $client->click($link);

        $this->assertEquals('/salon/warhammer-40k/1478304000', $client->getRequest()->getPathInfo());
    }

    public function testFormWarhammer40k()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/warhammer-40k/1478304000');

        $form = $crawler->selectButton('Valider')->form(array(
            'warhammer40k[name]' => 'Partie 1',
            'warhammer40k[players]' => 5,
            'warhammer40k[style]' => "Entrainement tournoi",
            'warhammer40k[armyPoints]' => 10,
            'warhammer40k[cpmPoints]' => 100,
        ));
        $client->submit($form);
    }

    public function testWarhammerBattleLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/1478304000');
        $link = $crawler->selectLink('WARHAMMER BATTLE')->link();
        $client->click($link);

        $this->assertEquals('/salon/warhammer-battle/1478304000', $client->getRequest()->getPathInfo());
    }

    public function testFormWarhammerBattle()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/warhammer-battle/1478304000');

        $form = $crawler->selectButton('Valider')->form(array(
            'warhammer_battle[name]' => 'Partie 2',
            'warhammer_battle[players]' => 4,
            'warhammer_battle[style]' => 'Jeu amical',
            'warhammer_battle[mode]' => '8th',
            'warhammer_battle[armyPoints]' => 50,
        ));
        $client->submit($form);
    }

    public function testBoardgameLink()
    {
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/1478304000');
        $link = $crawler->selectLink('JEU DE PLATEAU')->link();
        $client->click($link);

        $this->assertEquals('/salon/jeu-de-plateau/1478304000', $client->getRequest()->getPathInfo());
    }

    public function testFormBoardgame()
    {
        $client = static::createClient(array('debug' => true, 'environment' => 'test'), array(
            'HTTP_HOST' => 'localhost'
        ));
        $client = $this->logIn();
        $crawler = $client->request('GET', '/salon/jeu-de-plateau/1478304000');

        $form = $crawler->selectButton('Valider')->form(array(
            'board_game[name]' => 'Partie 3',
            'board_game[players]' => 4,
        ));
        $client->submit($form);
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