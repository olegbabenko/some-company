<?php

declare(strict_types=1);

namespace App\Service;

interface ContentInterface
{
    public function getContent(string $path);
}
