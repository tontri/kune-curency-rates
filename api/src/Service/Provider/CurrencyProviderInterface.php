<?php

namespace App\Service\Provider;

use App\Service\Mapper\OhlcDtoCollection;

interface CurrencyProviderInterface
{
    /**
     * @return OhlcDtoCollection
     */
    public function getOLHC(): OhlcDtoCollection;

}