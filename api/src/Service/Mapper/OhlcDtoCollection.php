<?php

namespace App\Service\Mapper;

use App\Dto\OHLC;
use ArrayObject;
use InvalidArgumentException;

class OhlcDtoCollection extends ArrayObject
{
    /**
     * @param mixed $index
     * @param mixed $newval
     */
    public function offsetSet($index,$newval)
    {
        if (!$newval instanceof OHLC) {
            throw new InvalidArgumentException('Newval must be instance of OHLC');
        }

        parent::offsetSet($index, $newval);
    }
}
