<?php

namespace App\Service\Storage;

use App\Dto\OHLC;
use App\Entity\OhlcTrack;
use App\Service\Dictionary\DictionaryInterface;
use App\Service\Mapper\OhlcDtoCollection;
use Doctrine\ORM\EntityManagerInterface;

class OhlcStorage implements OhlcStorageInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var DictionaryInterface
     */
    private $dictionary;

    /**
     * OhlcStorage constructor.
     * @param EntityManagerInterface $entityManager
     * @param DictionaryInterface $dictionary
     */
    public function __construct(EntityManagerInterface $entityManager, DictionaryInterface $dictionary)
    {
        $this->entityManager = $entityManager;
        $this->dictionary = $dictionary;
    }

    /**
     * @inheritdoc
     */
    public function addCurrencies(OhlcDtoCollection $ohlcCollection): bool
    {
        /**
         * @var OHLC $ohlcDto
         */
        foreach ($ohlcCollection as $ohlcDto) {

            $ohlcTrack = new OhlcTrack();
            $ohlcTrack->setProviderId($ohlcDto->getProviderId());
            $symbolCode = $this->dictionary->getCodeBysymbol($ohlcDto->getSymbol());
            $ohlcTrack->setSymbolCode($symbolCode)
                      ->setPriceBid($ohlcDto->getPriceBid())
                      ->setVolBid($ohlcDto->getVolBid())
                      ->setPriceAsk($ohlcDto->getPriceAsk())
                      ->setVolAsk($ohlcDto->getVolAsk())
                      ->setLastPrice($ohlcDto->getLastPrice())
                      ->setVol24Hours($ohlcDto->getVol24Hours())
                      ->setMinPrice24Hours($ohlcDto->getMinPrice24Hours())
                      ->setMaxPrice24Hours($ohlcDto->getMaxPrice24Hours())
                      ->setCreatedAt($ohlcDto->getCreatedAt());

            $this->entityManager->persist($ohlcTrack);
        }

        $this->entityManager->flush();
        return true;

    }

}