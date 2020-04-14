<?php

namespace App\Repository;

use App\Entity\OhlcTrack;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method OhlcTrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method OhlcTrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method OhlcTrack[]    findAll()
 * @method OhlcTrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OhlcTrackRepository extends AbstractTrackRepository
{
    /**
     * BtcUsdRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OhlcTrack::class);
    }

    /**
     * @param int $symbolCode
     * @param array $options
     * @return QueryBuilder
     */
    protected function getReportBuilder(int $symbolCode, array $options): QueryBuilder
    {
        return $this->getMetricBuilder($options)
            ->addSelect('track.symbolCode as symbolCode')
            ->andWhere('track.symbolCode  = :symbol_code')
            ->setParameter('symbol_code', $symbolCode);
    }


}
