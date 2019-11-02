<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\Money\Wallet\Entity\Wallet;

use App\Tests\Builder\Money\Wallet\CurrencyBuilder;
use PHPUnit\Framework\TestCase;
use App\Tests\Builder\Money\Wallet\WalletBuilder;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class WalletTest extends TestCase
{
    public function testMinus(): void
    {
        $currency = (new CurrencyBuilder())->rub()->build();
        $wallet = (new WalletBuilder())->withCurrency($currency)->balance(1000.0)->build();
        $wallet->minus($currency, 100.00);
        self::assertEquals(900.0, $wallet->getBalance());

        self::expectExceptionMessage('Balance cannot be negative');
        $wallet->minus($currency, 1000.0);
    }

    public function testPlus(): void
    {
        $currency = (new CurrencyBuilder())->rub()->build();
        $wallet = (new WalletBuilder())->withCurrency($currency)->balance(1000.0)->build();
        $wallet->plus($currency, 100.00);
        self::assertEquals(1100.0, $wallet->getBalance());
    }
}