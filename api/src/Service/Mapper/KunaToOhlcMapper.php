<?php

namespace App\Service\Mapper;

use App\Dto\OHLC;
use App\Service\Provider\KUNAProvider;
use DateTimeImmutable;
use Exception;
use LogicException;
use Psr\Http\Message\ResponseInterface;

class KunaToOhlcMapper implements OhlcMapperInterface
{
    /**
     * @inheritdoc
     * @throws Exception
     */
    public function map(ResponseInterface $kunaResponse): OhlcDtoCollection
    {
        $responseContent = $kunaResponse->getBody()->getContents();
        $decodedData = json_decode($responseContent);

        if (!is_array($decodedData) && empty($decodedData[0])) {
            throw new LogicException('Can\'t decode KUNA Response');
        }

        $ohlcCollection = new OhlcDtoCollection();

        foreach ($decodedData as $marketData) {
            $ohlc = new OHLC();
            $ohlc->setProviderId(KUNAProvider::PROVIDER_ID);
            $ohlc->setSymbol($marketData[0]);
            $ohlc->setPriceBid($marketData[1]);
            $ohlc->setVolBid($marketData[2]);
            $ohlc->setPriceAsk($marketData[3]);
            $ohlc->setVolAsk($marketData[4]);
            $ohlc->setLastPrice($marketData[7]);
            $ohlc->setVol24Hours($marketData[8]);
            $ohlc->setMaxPrice24Hours($marketData[9]);
            $ohlc->setMinPrice24Hours($marketData[10]);
            $ohlc->setCreatedAt(new DateTimeImmutable());
            $ohlcCollection[] = $ohlc;
        }

        return $ohlcCollection;
    }

}