<?php

namespace App\Service\Mapper;

use App\Dto\OHLC;
use Psr\Http\Message\ResponseInterface;

interface OhlcMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return OHLC
     */
    public function map(ResponseInterface $response): OHLC;
}