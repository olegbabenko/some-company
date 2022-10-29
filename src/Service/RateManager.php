<?php

declare(strict_types=1);

namespace App\Service;

use App\Dictionary\DataPaths;

class RateManager
{
    private UrlContentManager $urlContentManager;

    /**
     * @param UrlContentManager $urlContentManager
     */
    public function __construct(UrlContentManager $urlContentManager)
    {
        $this->urlContentManager = $urlContentManager;
    }

    /**
     * @param string $currency
     *
     * @return float|null
     */
    public function getRateByCurrency(string $currency): ?float
    {
        $result = $this->urlContentManager->getContent(DataPaths::RATES_PATH);

       if (array_key_exists('rates', $result)) {
           return $result['rates'][$currency];
       }

       return null;
    }
}
