<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "method"="GET",
 *              "openapi_context" = {
 *                  "parameters" = {
 *                      {
 *                          "name" = "symbol",
 *                          "in" = "query",
 *                          "description" = "Currency pair for display on the chart",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "example": "btcusd or btcuah or btcrub"
 *                      },
 *                      {
 *                          "name" = "startDate",
 *                          "in" = "query",
 *                          "description" = "Begin of period",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "format":"date",
 *                          "example": "2020-04-12"
 *                      },
 *                      {
 *                          "name" = "endDate",
 *                          "in" = "query",
 *                          "description" = "End of period",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "format":"date",
 *                          "example": "2020-04-14"
 *                      }
 *                  }
 *               }
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OhlcTrackRepository")
 */
class OhlcTrack
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $providerId;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $symbolCode;

    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $priceBid;

    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $volBid;

    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $priceAsk;

    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $volAsk;

    /**
     * @var string
     * @ORM\Column(type="decimal")
     */
    private $lastPrice;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="vol_24_hours")
     */
    private $vol24Hours;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="max_price_24_hours")
     */
    private $maxPrice24Hours;

    /**
     * @var string
     * @ORM\Column(type="decimal", name="min_price_24_hours")
     */
    private $minPrice24Hours;

    /**
     * @var DateTimeInterface
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return OhlcTrack
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string $idTrack
     * @return OhlcTrack
     */
    public function setIdTrack(string $idTrack): self
    {
        $this->id = $idTrack;

        return $this;
    }

    /**
     * @return int
     */
    public function getProviderId(): int
    {
        return $this->providerId;
    }

    /**
     * @param int $providerId
     * @return OhlcTrack
     */
    public function setProviderId(int $providerId): self
    {
        $this->providerId = $providerId;

        return $this;
    }

    /**
     * @return int
     */
    public function getSymbolCode(): int
    {
        return $this->symbolCode;
    }

    /**
     * @param int $symbolCode
     * @return OhlcTrack
     */
    public function setSymbolCode(int $symbolCode): self
    {
        $this->symbolCode = $symbolCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceBid(): string
    {
        return $this->priceBid;
    }

    /**
     * @param string $priceBid
     * @return BtcUsd
     */
    public function setPriceBid(string $priceBid): self
    {
        $this->priceBid = $priceBid;

        return $this;
    }

    /**
     * @return string
     */
    public function getVolBid(): string
    {
        return $this->volBid;
    }

    /**
     * @param string $volBid
     * @return BtcUsd
     */
    public function setVolBid(string $volBid): self
    {
        $this->volBid = $volBid;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriceAsk(): string
    {
        return $this->priceAsk;
    }

    /**
     * @param string $priceAsk
     * @return BtcUsd
     */
    public function setPriceAsk(string $priceAsk): self
    {
        $this->priceAsk = $priceAsk;

        return $this;
    }

    /**
     * @return string
     */
    public function getVolAsk(): string
    {
        return $this->volAsk;
    }

    /**
     * @param string $volAsk
     * @return BtcUsd
     */
    public function setVolAsk(string $volAsk): self
    {
        $this->volAsk = $volAsk;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastPrice(): string
    {
        return $this->lastPrice;
    }

    /**
     * @param string $lastPrice
     * @return BtcUsd
     */
    public function setLastPrice(string $lastPrice): self
    {
        $this->lastPrice = $lastPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getVol24Hours(): string
    {
        return $this->vol24Hours;
    }

    /**
     * @param string $vol24Hours
     * @return BtcUsd
     */
    public function setVol24Hours(string $vol24Hours): self
    {
        $this->vol24Hours = $vol24Hours;

        return $this;
    }

    /**
     * @return string
     */
    public function getMaxPrice24Hours(): string
    {
        return $this->maxPrice24Hours;
    }

    /**
     * @param string $maxPrice24Hours
     * @return BtcUsd
     */
    public function setMaxPrice24Hours(string $maxPrice24Hours): self
    {
        $this->maxPrice24Hours = $maxPrice24Hours;

        return $this;
    }

    /**
     * @return string
     */
    public function getMinPrice24Hours(): string
    {
        return $this->minPrice24Hours;
    }

    /**
     * @param string $minPrice24Hours
     * @return BtcUsd
     */
    public function setMinPrice24Hours(string $minPrice24Hours): self
    {
        $this->minPrice24Hours = $minPrice24Hours;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface $createdAt
     * @return BtcUah
     */
    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     *
     * @throws Exception
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new DateTimeImmutable();

        return $this;
    }
}
