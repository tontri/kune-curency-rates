<?php

namespace App\Handler;

use App\Service\Mapper\OhlcDtoCollection;
use App\Service\Storage\OhlcStorageInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class OhlcCollectionHandler implements MessageSubscriberInterface
{
    /**
     * @var OhlcStorageInterface
     */
    private $ohlcStorage;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * OhlcCollectionHandler constructor.
     * @param OhlcStorageInterface $ohlcStorage
     * @param LoggerInterface $logger
     */
    public function __construct(OhlcStorageInterface $ohlcStorage, LoggerInterface $logger)
    {
        $this->ohlcStorage = $ohlcStorage;
        $this->logger = $logger;
    }

    /**
     * @param OhlcDtoCollection $message
     */
    public function __invoke(OhlcDtoCollection $message)
    {
        try {
            $this->ohlcStorage->addCurrencies($message);
        } catch (Exception $e) {
            $this->logger->error('Error When save new currencies in storage \r\n '
                             . 'Message: '. $e->getMessage() . '\r\n'
                             . 'Code: '. $e->getCode() . '\r\n'
                             . 'File:'. $e->getFile() . '\r\n'
                             . 'Line:' . $e->getLine() . '\r\n'
                             . 'Trace' . $e->getTraceAsString()
            );
        }
    }


    public static function getHandledMessages(): iterable
    {
        // handle this message on __invoke
        yield OhlcDtoCollection::class;

    }
}