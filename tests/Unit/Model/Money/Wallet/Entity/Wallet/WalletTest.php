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
        $rub = (new CurrencyBuilder())->rub()->build();
        $wallet = (new WalletBuilder())->withCurrency($rub)->balance(1000.0)->build();
        $wallet->minus( 100.00);
        self::assertEquals(900.0, $wallet->getBalance());

        self::expectExceptionMessage('Balance cannot be negative');
        $wallet->minus( 1000.0);
        self::assertEquals($rub->getCode(), $wallet->getCurrency()->getCode());
    }

    public function testMinusChangeRubToUsd(): void
    {
        $rub = (new CurrencyBuilder())->rub()->build();
        $usd = (new CurrencyBuilder())->usd()->withValue(65.0)->build();

        $wallet = (new WalletBuilder())->withCurrency($rub)->balance(6500.0)->build();

        $wallet->minus( 5.0, $usd);
        self::assertEquals(95.0, $wallet->getBalance());
        self::assertEquals($usd->getCode(), $wallet->getCurrency()->getCode());

        $wallet = (new WalletBuilder())->withCurrency($rub)->balance(6500.0)->build();
        self::expectExceptionMessage('Balance cannot be negative');
        $wallet->minus( 5000.0, $usd);
    }

    public function testMinusChangeUsdToRub(): void
    {
        $rub = (new CurrencyBuilder())->rub()->build();
        $usd = (new CurrencyBuilder())->usd()->withValue(65.0)->build();

        $wallet = (new WalletBuilder())->withCurrency($usd)->balance(6500.0)->build();

        $wallet->minus( 1000.0, $rub);
        self::assertEquals(421500.0, $wallet->getBalance());
        self::assertEquals($rub->getCode(), $wallet->getCurrency()->getCode());

        $wallet = (new WalletBuilder())->withCurrency($usd)->balance(1000.0)->build();
        self::expectExceptionMessage('Balance cannot be negative');
        $wallet->minus( 70000.0, $rub);
    }

    public function testPlus(): void
    {
        $rub = (new CurrencyBuilder())->rub()->build();
        $wallet = (new WalletBuilder())->withCurrency($rub)->balance(1000.0)->build();
        $wallet->plus( 100.00);
        self::assertEquals(1100.0, $wallet->getBalance());
        self::assertEquals($rub->getCode(), $wallet->getCurrency()->getCode());
    }

    public function testPlusChangeRubToUsd(): void
    {
        $rub = (new CurrencyBuilder())->rub()->build();
        $usd = (new CurrencyBuilder())->usd()->withValue(65.0)->build();

        $wallet = (new WalletBuilder())->withCurrency($rub)->balance(6500.0)->build();

        $wallet->plus( 5.0, $usd);
        self::assertEquals(105.0, $wallet->getBalance());
        self::assertEquals($usd->getCode(), $wallet->getCurrency()->getCode());
    }

    public function testPlusChangeUsdToRub(): void
    {
        $rub = (new CurrencyBuilder())->rub()->build();
        $usd = (new CurrencyBuilder())->usd()->withValue(65.0)->build();

        $wallet = (new WalletBuilder())->withCurrency($usd)->balance(6500.0)->build();

        $wallet->plus( 1000.0, $rub);
        self::assertEquals(423500.0, $wallet->getBalance());
        self::assertEquals($rub->getCode(), $wallet->getCurrency()->getCode());
    }
}