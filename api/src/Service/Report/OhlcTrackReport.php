<?php

namespace App\Service\Report;

use App\Entity\OhlcTrack;
use App\Repository\OhlcTrackRepository;
use App\Service\Dictionary\DictionaryInterface;
use App\Service\Mapper\OhlcMapperInterface;
use DateTimeInterface;
use Symfony\Component\Serializer\SerializerInterface;

class OhlcTrackReport extends AbstractTrackReport
{
    /**
     * @var OhlcTrackRepository
     */
    protected $trackRepository;

    /**
     * @var OhlcMapperInterface
     */
    protected $ohlcMapper;

    /**
     * @var DictionaryInterface
     */
    protected $currencyDictionary;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * OhlcTrackReport constructor.
     * @param OhlcTrackRepository $trackRepository
     * @param OhlcMapperInterface $ohlcMapper
     * @param DictionaryInterface $dictionary
     */
    public function __construct(OhlcTrackRepository $trackRepository, OhlcMapperInterface $ohlcMapper, DictionaryInterface $dictionary, SerializerInterface $serializer)
    {
        parent::__construct($trackRepository, $ohlcMapper);
        $this->currencyDictionary = $dictionary;
        $this->serializer = $serializer;
    }

    /**
     * @inheritdoc
     */
    public function getCollectionData(string $symbol, DateTimeInterface $startDate, DateTimeInterface $endDate): iterable
    {
        $symbolCode = $this->currencyDictionary->getCodeBySymbol($symbol);
        $ohlcTrackArr = $this->trackRepository->findBySymbolGropedByHour($symbolCode, ['startDate' => $startDate, 'endDate' => $endDate]);
        $ohlcTrackJson = json_encode($ohlcTrackArr);
        return $this->serializer->deserialize($ohlcTrackJson, OhlcTrack::class . '[]', 'json' );
    }

}
