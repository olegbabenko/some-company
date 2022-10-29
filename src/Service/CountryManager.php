<?php

declare(strict_types=1);

namespace App\Service;

use App\Dictionary\CountryCodes;

class CountryManager
{
    /**
     * @param string $code
     *
     * @return bool
     */
    public function isEuCountry(string $code): bool
    {
        if (in_array($code, CountryCodes::EU_COUNTRIES)) {
            return true;
        }

        return false;
    }
}
