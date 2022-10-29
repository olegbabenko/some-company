<?php

namespace App\Tests\Service;

use App\Service\RateManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RateManagerTest extends KernelTestCase
{
    /**
     * @param string $currency
     * @param float  $rate
     * @dataProvider additionalProvider
     *
     * @return void
     */
    public function testGetRateByCurrency(string $currency, float $rate): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $rateManager = $this->createMock(RateManager::class);
        $rateManager->method('getRateByCurrency')->willReturn($rate);
        $this->assertSame($rate, $rateManager->getRateByCurrency($currency));
    }

    /**
     * @return string[][]
     */
    private function additionalProvider(): array
    {
        return [
            ['currency' => 'EUR', 'rate' => 1.00],
            ['currency' => 'USD', 'rate' => 0.998],
        ];
    }
}
