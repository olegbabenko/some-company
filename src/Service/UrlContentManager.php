<?php

declare(strict_types=1);

namespace App\Service;

class UrlContentManager implements ContentInterface
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function getContent(string $path): array
    {
        try {
            return json_decode(file_get_contents($path), true);
        } catch (\Throwable $throwable) {
            // exception logging, etc.
            return [];
        }
    }
}
