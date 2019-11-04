<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\UseCase\Transaction;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class Command
{
    /**
     * @var int
     */
    public $walletId;

    /**
     * Название валюты
     * @var string
     */
    public $currency;

    /**
     * Тип транзакции
     * @var string
     */
    public $type;

    /**
     * Сумма на которую изменяется баланс
     * @var float
     */
    public $amount;

    /**
     * Причина
     * @var string
     */
    public $cause;

    public function __construct(int $walletId, string $currency, string $type, float $amount, string $cause)
    {
        $this->walletId = $walletId;
        $this->currency = $currency;
        $this->type = $type;
        $this->amount = $amount;
        $this->cause = $cause;
    }
}