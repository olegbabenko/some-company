<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\CountryManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CountryManagerTest extends KernelTestCase
{
    /**
     * @param string $code
     * @dataProvider additionalProvider
     *
     * @return void
     * @throws \Exception
     */
    public function testisEuCountrySuccess(string $code): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $countryManager = static::getContainer()->get(CountryManager::class);
        $this->assertIsBool($countryManager->isEuCountry($code));
        $this->assertSame(true, $countryManager->isEuCountry($code));
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testisEuCountryFail(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $countryManager = static::getContainer()->get(CountryManager::class);
        $this->assertIsBool($countryManager->isEuCountry('US'));
        $this->assertSame(false, $countryManager->isEuCountry('US'));
    }

    /**
     * @return string[][]
     */
    private function additionalProvider(): array
    {
        return [
            ['code' => 'CZ'],
            ['code' => 'LV'],
        ];
    }
}
