<?php

declare(strict_types=1);

namespace App\Model\Money\Wallet\Entity\Wallet;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet_wallets")
 * @author sergey seryozhasafonov@gmail.com
 */
class Wallet
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Currency
     * @ORM\OneToOne(targetEntity="App\Model\Money\Wallet\Entity\Currency\Currency")
     */
    private $currency;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=false)
     */
    private $balance;

    private function __construct(Currency $currency, float $balance)
    {
        $this->currency = $currency;
        $this->balance = $balance;
    }

    public static function create(Currency $currency, float $balance): self
    {
        return new self($currency, $balance);
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function changeCurrency(Currency $currency): void
    {
        // TODO: Сделать переконвертацию баланса
        if (!$this->currency->equalCode($currency->getCode())) {
            $this->currency = $currency;
        }
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function minus(Currency $currency, float $amount): void
    {
        $this->changeCurrency($currency);
        if ($this->balance - $amount < 0) {
            throw new \DomainException('Balance cannot be negative');
        }
        $this->balance -= $amount;
    }

    public function plus(Currency $currency, float $amount): void
    {
        $this->changeCurrency($currency);
        $this->balance += $amount;
    }
}