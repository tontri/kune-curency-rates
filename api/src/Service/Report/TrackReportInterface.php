<?php

namespace App\Service\Report;

use DateTimeInterface;

interface TrackReportInterface
{
    /**
     * @param string $symbol
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     * @return iterable
     */
    public function getCollectionData(string $symbol, DateTimeInterface $startDate, DateTimeInterface $endDate): iterable;
}