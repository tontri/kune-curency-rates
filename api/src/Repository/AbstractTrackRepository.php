<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\OhlcTrack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @method OhlcTrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method OhlcTrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method OhlcTrack[]    findAll()
 * @method OhlcTrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class AbstractTrackRepository extends ServiceEntityRepository
{
    /**
     * @param int   $symbol
     * @param array $options
     * @return array
     */
    public function findBySymbolGropedByHour(int $symbol, array $options): array
    {

        return $this->getReportBuilder($symbol, $options)
                    ->addSelect("track.id as idTrack")
                    ->addSelect("track.providerId as providerId")
                    ->addSelect("DATE_FORMAT (track.createdAt, '%Y-%m-%d %H:00:00') as createdAt")
                    ->addGroupBy('createdAt')
                    ->getQuery()
                    ->getResult();

    }


    /**
     * @param array $options
     * @return QueryBuilder
     */
    protected function getMetricBuilder(array $options): QueryBuilder
    {
        return $this->createQueryBuilder('track')
                    ->select([
                        'AVG(track.priceBid) AS priceBid',
                        'AVG(track.volBid) AS volBid',
                        'AVG(track.priceAsk) AS priceAsk',
                        'AVG(track.volAsk) AS volAsk',
                        'AVG(track.lastPrice) AS lastPrice',
                        'MAX(track.vol24Hours) AS vol24Hours',
                        'MAX(track.maxPrice24Hours) AS maxPrice24Hours',
                        'MIN(track.minPrice24Hours) AS minPrice24Hours',
                    ])
                    ->andWhere('DATE_FORMAT (track.createdAt, \'%Y-%m-%d\') BETWEEN :start_date AND :end_date')
                    ->setParameters([
                        'start_date' =>  $options['startDate'],
                        'end_date' => $options['endDate'],
                    ]);
    }

    /**
     * @param int $symbolCode
     * @param array $options
     * @return QueryBuilder
     */
    abstract protected function getReportBuilder(int $symbolCode, array $options): QueryBuilder;
}
