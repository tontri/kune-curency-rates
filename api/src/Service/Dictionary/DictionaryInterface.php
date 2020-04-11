<?php

namespace App\Service\Dictionary;

interface DictionaryInterface
{
    /**
     * @return array
     */
    public function getItems(): array;
}