<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\BinManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BinManagerTest extends KernelTestCase
{
    /**
     * @param $bin
     * @param $alpha2
     * @dataProvider additionalProvider
     *
     * @return void
     * @throws \Exception
     */
    public function testGetDataSuccess($bin, $alpha2): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $binManager = $this->createMock(BinManager::class);
        $binManager->method('getData')->willReturn(
            [
                'country' => [
                    'alpha2' => $alpha2
                ]
            ]
        );
        $this->assertIsArray($binManager->getData($bin));
        $this->assertArrayHasKey('country', $binManager->getData($bin));
        $this->assertSame($alpha2, $binManager->getData($bin)['country']['alpha2']);

    }

    /**
     * @param $bin
     * @dataProvider additionalProvider
     *
     * @return void
     */
    public function testGetDataFail($bin): void
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $binManager = $this->createMock(BinManager::class);
        $binManager->method('getData')->willReturn(
            []
        );
        $this->assertIsArray($binManager->getData($bin));
        $this->assertNotContains('country', $binManager->getData($bin));
    }

    /**
     * @return string[][]
     */
    private function additionalProvider(): array
    {
        return [
           ['bin' => '516793', 'alpha2' => 'LT'],
           ['bin' => '41417360', 'alpha2' => 'US'],
        ];
    }
}
