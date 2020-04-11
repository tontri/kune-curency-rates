<?php

namespace App\Service\Provider;

use App\Dto\OHLC;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Service\Mapper\OhlcMapperInterface;

class KUNAProvider implements CurrencyProviderInterface
{
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
     * KUNAProvider constructor.
     * @param ClientInterface $client
     * @param OhlcMapperInterface $ohlcMapper
     */
    public function __construct(ClientInterface $client, OhlcMapperInterface $ohlcMapper)
    {
        $this->guzzle = $client;
        $this->kunaToOhlcMapper = $ohlcMapper;
    }

    /**
     * @param string $symbol
     * @return OHLC
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOLHC(string $symbol): OHLC
    {

        $response = $this->guzzle->request('GET', self::API_V3_URL . '/tickers', ['query' => ['symbols' => $symbol]]);


        if (\Symfony\Component\HttpFoundation\Response::HTTP_OK !== $response->getStatusCode()) {
            throw new LogicException('Wrong http status code');
        }

        return $this->kunaToOhlcMapper->map($response);
    }
}