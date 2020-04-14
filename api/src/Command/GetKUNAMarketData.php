<?php

namespace App\Command;

use App\Service\Provider\CurrencyProviderInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class GetKUNAMarketData
 * @package App\Command
 */
class GetKUNAMarketData extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'market:get-kuna-data';

    /**
     * @var CurrencyProviderInterface
     */
    private $kunaProvider;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var MessageBusInterface
     */
    private $bus;

    /**
     * GetKUNAMarketData constructor.
     * @param CurrencyProviderInterface $currencyProvider
     * @param LoggerInterface $logger
     * @param MessageBusInterface $bus
     */
    public function __construct(CurrencyProviderInterface $currencyProvider, LoggerInterface $logger, MessageBusInterface $bus)
    {
        parent::__construct();
        $this->kunaProvider = $currencyProvider;
        $this->logger = $logger;
        $this->bus = $bus;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        try {
            $ohlcDtoCollection = $this->kunaProvider->getOLHC();

            $this->bus->dispatch($ohlcDtoCollection);

            $output->writeln('Kuna data was sent to the buffer.');

        } catch (Exception $e) {
            $this->logger->error('Error when parsing kuna data: \r\n'
                            . 'Error: ' . $e->getMessage() . '\r\n'
                            . 'Trace: ' . $e->getTraceAsString());
            $output->writeln(['Error:', $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine()]);
        }
    }
}
