<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\OhlcTrack;
use App\Service\Report\OhlcTrackReport;
use App\Service\Report\TrackReportInterface;
use DateTimeImmutable;
use DateTimeInterface;
use LogicException;

final class OhlcTrackCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var OhlcTrackReport
     */
    private $ohlcTrackReport;

    /**
     * @var array
     */
    private $context;

    /**
     * OhlcTrackCollectionDataProvider constructor.
     * @param TrackReportInterface $ohlcTrackReport
     */
    public function __construct(TrackReportInterface  $ohlcTrackReport)
    {
        $this->ohlcTrackReport = $ohlcTrackReport;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        $this->context = $context;
        return OhlcTrack::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return iterable
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $result = $this->ohlcTrackReport->getCollectionData(
            $this->getSymbolFromFilter(),
            $this->getStartDateFromFilter(),
            $this->getEndDateFromFilter()
        );

        return $result;
    }

    /**
     * @return iterable
     */
    private function getFilters(): iterable
    {
        return !empty($this->context['filters']) ? $this->context['filters'] : [];
    }

    /**
     * @return string
     */
    private function getSymbolFromFilter(): string
    {
        $filters = $this->getFilters();
        if (empty($filters['symbol'])) {
            throw new LogicException('Can\'t find symbol in filters');
        }
        return $filters['symbol'];
    }

    /**
     * @return DateTimeInterface
     */
    private function getStartDateFromFilter(): DateTimeInterface
    {
        $filters = $this->getFilters();
        if (empty($filters['startDate'])) {
            throw new LogicException('Can\'t find startDate in filters');
        }

        return DateTimeImmutable::createFromFormat('Y-m-d', $filters['startDate']);
    }

    /**
     * @return DateTimeInterface
     */
    private function getEndDateFromFilter(): DateTimeInterface
    {
        $filters = $this->getFilters();
        if (empty($filters['endDate'])) {
            throw new LogicException('Can\'t find endDate in filters');
        }

        return DateTimeImmutable::createFromFormat('Y-m-d', $filters['endDate']);
    }


}

