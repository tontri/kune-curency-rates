<?php

namespace App\Service\Dictionary;

class CurrencyDictionary implements DictionaryInterface
{
    /**
     * currency code => currency name
     */
    private const CURRENCY = [
        11 => 'btcusd',
        12 => 'btcuah',
        13 => 'btcrub',
    ];

    /**
     * @return array
     */
    public function getItems(): array
    {
        return self::CURRENCY;
    }

    /**
     * @param string $symbol
     * @return int
     */
    public function getCodeBySymbol(string $symbol): int
    {
        return array_search($symbol, self::CURRENCY);
    }
}