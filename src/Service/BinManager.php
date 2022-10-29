<?php

declare(strict_types=1);

namespace App\Service;

use App\Dictionary\DataPaths;

class BinManager
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
     * @param string $bin
     *
     * @return array|null
     */
    public function getData(string $bin): ?array
    {
        $result = $this->urlContentManager->getContent(DataPaths::BIN_PATH . $bin);

        if (array_key_exists('country', $result)) {
            return $result;
        }

        return null;
    }
}
