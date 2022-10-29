<?php

declare(strict_types=1);

namespace App\Dictionary;

class DataPaths
{
    public const INPUT_FILE_NAME = 'input.txt';
    public const BIN_PATH = 'https://lookup.binlist.net/';
    public const RATES_PATH = 'https://api.exchangerate.host/latest';

    /**
     * @return string
     */
    public static function getFilePath(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . self::INPUT_FILE_NAME;
    }
}
