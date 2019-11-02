<?php

declare(strict_types=1);

namespace App\Tests\Builder\Money\Wallet;

use App\Model\Money\Wallet\Entity\Wallet\Wallet;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class WalletBuilder
{

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var float
     */
    private $balance;

    public function __construct()
    {
        $this->currency = Currency::createRUB();
        $this->balance = 0.0;
    }

    public function withCurrency(Currency $currency): self
    {
        $clone = clone $this;
        $clone->currency = $currency;
        return $clone;
    }

    public function balance(float $balance): self
    {
        $clone = clone $this;
        $clone->balance = $balance;
        return $clone;
    }

    public function build(): Wallet
    {
        return Wallet::create($this->currency, $this->balance);
    }

}