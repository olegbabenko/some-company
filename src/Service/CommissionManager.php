<?php

namespace App\Service;

use App\Dictionary\DataPaths;
use App\Dictionary\Currency;

class CommissionManager
{
    private CountryManager $countryManager;
    private FileContentManager $fileContentManager;
    private BinManager $binManager;
    private RateManager $rateManager;

    /**
     * @param CountryManager     $countryManager
     * @param FileContentManager $fileContentManager
     * @param BinManager         $binManager
     * @param RateManager        $rateManager
     */
    public function __construct(
        CountryManager $countryManager,
        FileContentManager $fileContentManager,
        BinManager $binManager,
        RateManager $rateManager
    )
    {
        $this->countryManager = $countryManager;
        $this->fileContentManager = $fileContentManager;
        $this->binManager =  $binManager;
        $this->rateManager = $rateManager;
    }

    /**
     * @return array
     */
    public function getCommissions(): array
    {
        $result = [];
        $transactions = $this->fileContentManager->getContent(DataPaths::getFilePath());

        if (empty($transactions)) {
            $result[] = 'Something went wrong. Transaction data is empty';
        }

        foreach ($transactions as $transaction) {
            $transactionData = json_decode($transaction, true);
            $rate = $this->rateManager->getRateByCurrency($transactionData['currency']);

            if ($rate === null) {
                $result[] = sprintf('Rate is absent for this currency: %s', $transactionData['currency']);
                continue;
            }

            $amount = $this->getCommissionAmount($transactionData['amount'], $transactionData['currency'], $rate);
            $binResult = $this->binManager->getData($transactionData['bin']);

            if ($binResult === null) {
                $result[] = sprintf('Bin data is absent for this card: %s', $transactionData['bin']);
                continue;
            }

            $result[] = number_format($amount * $this->getMultiplier($binResult['country']['alpha2']), 2);
        }

        return $result;
    }

    /**
     * @param string $amount
     * @param string $currency
     * @param float  $rate
     *
     * @return float
     */
    private function getCommissionAmount(string $amount, string $currency, float $rate): float
    {
        if ($currency === Currency::EUR || $rate == 0 ) {
            return $amount;
        }

        return $amount / $rate;
    }

    /**
     * @param string $countryCode
     *
     * @return float
     */
    private function getMultiplier(string $countryCode): float
    {
        if ($this->countryManager->isEuCountry($countryCode)) {
            return 0.01;
        }

        return 0.02;
    }
}
