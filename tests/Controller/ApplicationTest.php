<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationTest extends WebTestCase
{
    /**
     * @return void
     */
    public function testIndexAction(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/application/index');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Commissions');
        $this->assertCount(1, $crawler->filter('li'));
    }
}
