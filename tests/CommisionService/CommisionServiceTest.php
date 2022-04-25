<?php

declare(strict_types=1);

namespace CommisionService;

use App\Classes\BIN\BINInterface;
use App\Classes\CommissionService;
use App\Classes\DataProvider\DataProviderInterface;
use App\Classes\ExchangeRate\CountryExchangeRateInterface;
use App\Classes\Model\BinMetadata;
use App\Classes\Model\Transaction;
use PHPUnit\Framework\TestCase;

class CommisionServiceTest extends TestCase
{

    /**
     * @return void
     */
    public function testCalculateCommissionEurozone(): void
    {
        $binClass = $this->getMockedBinClass(1, 'DE');
        $exchangeClass = $this->getMockedExchangedRate(1);

        $transaction = new Transaction(1, 100.00, 'EUR');

        $commissionService = new CommissionService($binClass, $exchangeClass);
        $this->assertEquals($commissionService->calculate($transaction), 1);
    }

    /**
     * @return void
     */
    public function testCalculateCommissionNonEurozone(): void
    {
        $binClass = $this->getMockedBinClass(1, 'US');
        $exchangeClass = $this->getMockedExchangedRate(1.079936);

        $transaction = new Transaction(1, 50.00, 'USD');

        $commissionService = new CommissionService($binClass, $exchangeClass);

        $this->assertEquals($commissionService->calculate($transaction), 0.9259807988621548);
    }

    /**
     * @param int $binId
     * @param string $countryAlpha
     * @return BINInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private function getMockedBinClass(int $binId, string $countryAlpha)
    {
        $bin = $this->getMockBuilder(BINInterface::class)->getMock();
        $bin->expects($this->any())
            ->method('getBinMetaData')
            ->will($this->returnValue(new BinMetadata($binId, $countryAlpha)));

        return $bin;
    }

    /**
     * @param float $exchangeValue
     * @return CountryExchangeRateInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private function getMockedExchangedRate(float $exchangeValue)
    {
        $exchangeRit = $this->getMockBuilder(CountryExchangeRateInterface::class)->getMock();
        $exchangeRit->expects($this->any())
            ->method('getCountryExchangeRate')
            ->will($this->returnValue($exchangeValue));

        return $exchangeRit;
    }
}