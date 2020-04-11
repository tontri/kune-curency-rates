<?php

namespace App\Service\Provider;

use App\Dto\OHLC;

interface CurrencyProviderInterface
{
    /**
     * @param string $symbol
     * @return OHLC
     */
    public function getOLHC(string $symbol): OHLC;

}