<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Kostenko Anton <kostenko.antony@gmail.com>
 */
class ArticleControllerTest extends WebTestCase
{
    public function testHomepageh1()
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/homepage');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertEquals(1, $crawler->filter('h1:contains("Meteor")')->count());
    }

    public function testHomepageHtml()
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/homepage');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertGreaterThan(0, $crawler->filter('html:contains("Space")')->count());
    }

    public function testShow()
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/news/why-asteroids-taste-like-bacon');

        self::assertEquals(200, $client->getResponse()->getStatusCode());

        self::assertGreaterThan(0, $crawler->filter('html:contains("Share")')->count());
        self::assertEquals(1, $crawler->filter('button:contains("Comment")')->count());
    }
}