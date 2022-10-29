<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CommissionManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommissionManagerTest extends KernelTestCase
{
    /**
     * @return void
     */
    public function testGetCommissionsSuccess(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $commissionManager = $this->createMock(CommissionManager::class);
        $commissionManager->method('getCommissions')->willReturn(
            [
                1.00,
                0.75,
                1.24,
                36.72,
                45.12
            ]
        );
        $this->assertIsArray($commissionManager->getCommissions());
        $this->assertContains(1.00, $commissionManager->getCommissions());
    }

    /**
     * @return void
     */
    public function testGetCommissionsFail(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $commissionManager = $this->createMock(CommissionManager::class);
        $commissionManager->method('getCommissions')->willReturn(
            []
        );
        $this->assertIsArray($commissionManager->getCommissions());
        $this->assertNotContains(1.00, $commissionManager->getCommissions());
    }

    /**
     * @param string $amount
     * @param string $currency
     * @param float  $rate
     * @param string $result
     * @dataProvider additionalProvider
     *
     * @return void
     * @throws \Exception
     */
    public function testGetCommissionAmount(string $amount, string $currency, float $rate, string $result): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $commissionManager = static::getContainer()->get(CommissionManager::class);
        $this->assertSame($result, number_format($commissionManager->getCommissionAmount($amount, $currency, $rate), 2));
    }

    /**
     * @param string $countryCode
     * @param float $multiplier
     * @dataProvider additionalMultiplierProvider
     *
     * @return void
     * @throws \Exception
     */
    public function testGetMultiplier(string $countryCode, float $multiplier): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $commissionManager = static::getContainer()->get(CommissionManager::class);
        $this->assertSame($multiplier, $commissionManager->getMultiplier($countryCode));
    }

    /**
     * @return string[][]
     */
    private function additionalProvider(): array
    {
        return [
            ['amount' => '100.0', 'currency' => 'EUR', 'rate'=> 1.0, 'result' => '100.00'],
            ['amount' => '200.0', 'currency' => 'USD', 'rate'=> 0, 'result' => '200.00'],
            ['amount' => '75.0', 'currency' => 'USD', 'rate'=> 0.998, 'result' => '75.15'],
        ];
    }

    /**
     * @return string[][]
     */
    private function additionalMultiplierProvider(): array
    {
        return [
            ['countryCode' => 'LV', 'multiplier' => 0.01],
            ['countryCode' => 'CZ', 'multiplier' => 0.01],
            ['countryCode' => 'AZ', 'multiplier' => 0.02],
        ];
    }
}
