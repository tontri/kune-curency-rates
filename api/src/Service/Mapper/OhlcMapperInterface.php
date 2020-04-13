<?php

namespace App\Service\Mapper;

use Psr\Http\Message\ResponseInterface;

interface OhlcMapperInterface
{
    /**
     * @param ResponseInterface $response
     * @return OhlcDtoCollection
     */
    public function map(ResponseInterface $response): OhlcDtoCollection;
}