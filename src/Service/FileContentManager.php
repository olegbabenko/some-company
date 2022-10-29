<?php

declare(strict_types=1);

namespace App\Service;

class FileContentManager implements ContentInterface
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function getContent(string $path): array
    {
        try {
            return explode("\n", file_get_contents($path));
        } catch (\Throwable $throwable) {
            // exception logging, etc.
            return [];
        }
    }
}
