<?php

namespace App\Tests\Service;

use App\Service\UrlContentManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UrlContentManagerTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testGetContent(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $urlContentManager = $this->createMock(UrlContentManager::class);
        $urlContentManager->method('getContent')->willReturn(
            [
                'data' => 'test content'
            ]
        );
        $this->assertIsArray($urlContentManager->getContent('test.com/latest'));
        $this->assertArrayHasKey('data',$urlContentManager->getContent('test.com/latest') );
        $this->assertContains('test content',$urlContentManager->getContent('test.com/latest') );
    }
}
