<?php

namespace App\Classes\Command;

use App\Classes\Helper\CurrencyFormatter;
use App\Classes\DataProvider\File;
use App\Classes\BIN\BinlistClient;
use App\Classes\ExchangeRate\ExchangeRatesApi;
use App\Classes\Output\Console;
use App\Classes\CommissionService;

class CalculateCommissionsCommand implements ExecutableInterface
{
    /**
     * @return void
     */
    public function execute(...$params): void
    {
        $parser = new File($params[0]);
        $binClient = new BinlistClient($_ENV['BINLIST_API_URL']);
        $exchangeRateApi = new ExchangeRatesApi($_ENV['EXCHANGERATES_API_URL'], $_ENV['EXCHANGERATES_API_ACCESS_KEY']);
        $console = new Console();

        $commissionService = new CommissionService($binClient, $exchangeRateApi);

        foreach ($parser->getLine() as $transaction) {
            try {
                $commission = $commissionService->calculate($transaction);
                $console->writeLine(strval(CurrencyFormatter::format($commission)));
            } catch (\Exception $exception) {
                $console->writeLine("Couldn't get commission for {$transaction->getBinId()}: {$exception->getMessage()}");
            }
        }
    }
}