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

    /**
     * @var float
     */
    private $value;

    public function __construct()
    {
        $this->value = 1.0;
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

    public function withValue(float $value): self
    {
        $clone = clone $this;
        $clone->value = $value;
        return $clone;
    }

    public function build(): Currency
    {
        $currency = Currency::create($this->code);
        $currency->setValue($this->value);
        return $currency;
    }
}