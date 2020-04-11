<?php

namespace App\Service\Dictionary;

class CurrencyDictionary implements DictionaryInterface
{
    private const CURRENCY = [
        'btcusd',
        'btcuah',
        'btcrub',
        'ethuah',
        'ethbtc',
    ];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return self::CURRENCY;
    }
}