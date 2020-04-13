<?php

namespace App\Service\Storage;

use App\Service\Mapper\OhlcDtoCollection;

interface OhlcStorageInterface
{
    /**
     * @param OhlcDtoCollection $ohlcCollection
     * @return bool
     */
    public function addCurrencies(OhlcDtoCollection $ohlcCollection): bool;
}