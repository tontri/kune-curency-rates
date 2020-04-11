<?php

namespace App\Service\Mapper;

use App\Dto\OHLC;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;

class KunaToOhlcOhlcMapper implements OhlcMapperInterface
{
    /**
     * @inheritdoc
     */
    public function map(ResponseInterface $kunaResponse): OHLC
    {
        $responseContent = $kunaResponse->getBody()->getContents();
        $decodedData = json_decode($responseContent);
        if (!is_array($decodedData) && empty($decodedData[0])) {
            throw new LogicException('Can\'t decode KUNA Response');
        }

        $marketData = $decodedData[0];

        $ohlc = new OHLC();
        $ohlc->setSymbol($marketData[0]);
        $ohlc->setPriceBid($marketData[1]);
        $ohlc->setVolBid($marketData[2]);
        $ohlc->setPriceAsk($marketData[3]);
        $ohlc->setVolAsk($marketData[4]);
        $ohlc->setLastPrice($marketData[7]);
        $ohlc->setVolume24Hours($marketData[8]);
        $ohlc->setMaxPrice24Hours($marketData[9]);
        $ohlc->setMinPrice24Hours($marketData[10]);

        $ohlc->setCreatedAt(new DateTimeImmutable());

        return $ohlc;
    }

}