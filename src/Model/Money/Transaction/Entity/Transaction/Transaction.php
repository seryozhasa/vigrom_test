<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Entity\Transaction;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Money\Wallet\Entity\Wallet\Wallet;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 * @ORM\Entity
 * @ORM\Table(name="transactions")
 * @author sergey seryozhasafonov@gmail.com
 */
class Transaction
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Type
     * @ORM\Column(type="transaction_type")
     */
    private $type;

    /**
     * @var Wallet
     * @ORM\ManyToOne(targetEntity="App\Model\Money\Wallet\Entity\Wallet\Wallet")
     */
    private $wallet;

    /**
     * @var Currency
     * @ORM\ManyToOne(targetEntity="App\Model\Money\Wallet\Entity\Currency\Currency")
     */
    private $currency;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @var Cause
     * @ORM\Column(type="transaction_cause")
     */
    private $cause;

    private function __construct(Wallet $wallet, Type $type, Currency $currency, Cause $cause, float $amount)
    {
        $this->wallet = $wallet;
        $this->type = $type;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->cause = $cause;
    }

    public static function create(Wallet $wallet, Type $type, Currency $currency, Cause $cause, float $amount): self
    {
        return new self($wallet, $type, $currency, $cause, $amount);
    }

    public static function createDebit(Wallet $wallet, Currency $currency, Cause $cause, float $amount): self
    {
        return new self($wallet, Type::createDebit(), $currency, $cause, $amount);
    }

    public static function createCredit(Wallet $wallet, Currency $currency, Cause $cause, float $amount): self
    {
        return new self($wallet, Type::createCredit(), $currency, $cause, $amount);
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }


}