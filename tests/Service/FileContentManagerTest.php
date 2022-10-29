<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FileContentManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class FileContentManagerTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testGetContentSuccess(): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $fileContentManager = $this->createMock(FileContentManager::class);
        $fileContentManager->method('getContent')->willReturn(
            [
                '{"bin":"45717360","amount":"100.00","currency":"EUR"}',
                '{"bin":"516793","amount":"50.00","currency":"USD"}',
                '{"bin":"45417360","amount":"10000.00","currency":"JPY"}',
                '{"bin":"41417360","amount":"130.00","currency":"USD"}',
                '{"bin":"4745030","amount":"2000.00","currency":"GBP"}',
            ]
        );
        $this->assertIsArray($fileContentManager->getContent('input.txt'));
        $this->assertSame('45717360', json_decode($fileContentManager->getContent('input.txt')[0], true)['bin']);
    }
}
