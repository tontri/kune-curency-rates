<?php

namespace App\Service\Report;

use App\Repository\AbstractTrackRepository;
use App\Service\Mapper\OhlcMapperInterface;
use DateTimeInterface;

abstract class AbstractTrackReport implements TrackReportInterface
{
    /**
     * @var AbstractTrackRepository
     */
    protected $trackRepository;

    /**
     * @var OhlcMapperInterface
     */
    protected $ohlcMapper;

    /**
     * AbstractTrackService constructor.
     * @param AbstractTrackRepository $trackRepository
     * @param OhlcMapperInterface     $ohlcMapper
     */
    public function __construct(AbstractTrackRepository $trackRepository, OhlcMapperInterface $ohlcMapper)
    {
        $this->trackRepository = $trackRepository;
        $this->ohlcMapper = $ohlcMapper;
    }

    /**
     * @param string $symbol
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return iterable
     */
    abstract public function getCollectionData(string $symbol, DateTimeInterface $startDate, DateTimeInterface $endDate): iterable;
}
