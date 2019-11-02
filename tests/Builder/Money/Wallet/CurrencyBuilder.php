<?php

declare(strict_types=1);

namespace App\Tests\Builder\Money\Wallet;

use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class CurrencyBuilder
{
    /**
     * @var string
     */
    private $code;

    public function __construct()
    {
        $this->code = Currency::RUB;
    }

    public function rub(): self
    {
        $clone = clone $this;
        $clone->code = Currency::RUB;
        return $clone;
    }

    public function usd(): self
    {
        $clone = clone $this;
        $clone->code = Currency::USD;
        return $clone;
    }

    public function build(): Currency
    {
        return Currency::create($this->code);
    }
}