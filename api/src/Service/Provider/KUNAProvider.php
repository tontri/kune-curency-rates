<?php

namespace App\Service\Provider;

use App\Service\Dictionary\CurrencyDictionary;
use App\Service\Dictionary\DictionaryInterface;
use App\Service\Mapper\OhlcDtoCollection;
use GuzzleHttp\ClientInterface;
use LogicException;
use App\Service\Mapper\OhlcMapperInterface;

class KUNAProvider implements CurrencyProviderInterface
{
    public const PROVIDER_ID = 1;

    private const API_V3_URL = 'https://api.kuna.io/v3/';

    /**
     * @var ClientInterface
     */
    private $guzzle;

    /**
     * @var OhlcMapperInterface
     */
    private $kunaToOhlcMapper;

    /**
     * @var DictionaryInterface
     */
    private $currencyDictionary;

    /**
     * KUNAProvider constructor.
     * @param ClientInterface $client
     * @param OhlcMapperInterface $ohlcMapper
     * @param CurrencyDictionary $currencyDictionary
     */
    public function __construct(ClientInterface $client, OhlcMapperInterface $ohlcMapper, CurrencyDictionary $currencyDictionary)
    {
        $this->guzzle = $client;
        $this->kunaToOhlcMapper = $ohlcMapper;
        $this->currencyDictionary = $currencyDictionary;
    }

    /**
     * @return OhlcDtoCollection
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOLHC(): OhlcDtoCollection
    {
        $currencies = $this->currencyDictionary->getItems();
        $currenciesSymbols = implode(',', array_values($currencies));

        $response = $this->guzzle->request('GET', self::API_V3_URL . '/tickers', ['query' => ['symbols' => $currenciesSymbols]]);

        if (\Symfony\Component\HttpFoundation\Response::HTTP_OK !== $response->getStatusCode()) {
            throw new LogicException('Wrong http status code');
        }

        return $this->kunaToOhlcMapper->map($response);
    }
}