<?php

namespace App\Command;

use App\Service\Provider\CurrencyProviderInterface;
use App\Task\TaskMessageInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Log\Logger;

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
     * GetKUNAMarketData constructor.
     * @param CurrencyProviderInterface $currencyProvider
     * @param LoggerInterface $logger
     */
    public function __construct(CurrencyProviderInterface $currencyProvider, LoggerInterface $logger)
    {
        $this->kunaProvider = $currencyProvider;
        $this->logger = $logger;

        parent::__construct();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('Get kuna data:');

        try {
            $this->kunaProvider->getOLHC('btcusd');
        } catch (Exception $e) {
            $this->logger->error('Error: ' . $e->getMessage() . 'Trace: ' . $e->getTraceAsString());
            $output->writeln(['Error:', $e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine()]);
        }
    }
}
