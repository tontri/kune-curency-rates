<?php

namespace App\Dto;

use DateTimeImmutable;

class OHLC
{
    /**
     * @var int
     */
    private $providerId;

    /**
     * @var string
     */
    private $symbol;

    /**
     * @var string
     */
    private $priceBid;

    /**
     * @var string
     */
    private $volBid;

    /**
     * @var string
     */
    private $priceAsk;

    /**
     * @var string
     */
    private $volAsk;

    /**
     * @var string
     */
    private $lastPrice;

    /**
     * @var string
     */
    private $vol24Hours;

    /**
     * @var string
     */
    private $maxPrice24Hours;

    /**
     * @var string
     */
    private $minPrice24Hours;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getProviderId(): int
    {
        return $this->providerId;
    }

    /**
     * @param int $providerId
     * @return OHLC
     */
    public function setProviderId(int $providerId): self
    {
        $this->providerId = $providerId;

        return $this;
    }


    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     * @return OHLC
     */
    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
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
     * @return OHLC
     */
    public function setMinPrice24Hours(string $minPrice24Hours): self
    {
        $this->minPrice24Hours = $minPrice24Hours;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return OHLC
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}