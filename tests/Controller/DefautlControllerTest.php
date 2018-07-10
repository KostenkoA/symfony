<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefautlControllerTest extends WebTestCase
{
    public function testContacts()
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/contacts');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertEquals(1, $crawler->filter('a:contains("info@itea.ua")')->count());
    }

}