<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\Money\Wallet\Entity\Currency;

use PHPUnit\Framework\TestCase;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class CurrencyTest extends TestCase
{
    public function testCreateRUB()
    {
        $rub = Currency::create('RUB');
        self::assertEquals('RUB', $rub->getCode());
        self::assertTrue($rub->isRUB());

        $rub = Currency::create('rub');
        self::assertEquals('RUB', $rub->getCode());
        self::assertTrue($rub->isRUB());
    }

    public function testCreateUSD()
    {
        $usd = Currency::create('USD');
        self::assertEquals('USD', $usd->getCode());
        self::assertTrue($usd->isUSD());

        $usd = Currency::create('usd');
        self::assertEquals('USD', $usd->getCode());
        self::assertTrue($usd->isUSD());
    }

    public function testErrorCreate()
    {
        $this->expectException(\InvalidArgumentException::class);
        Currency::create('test_other_currency');
    }
}