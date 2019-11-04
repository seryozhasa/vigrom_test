<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\UseCase\Transaction;

use App\Model\Flusher;
use App\Model\Money\Transaction\Repository\TransactionRepository;
use App\Model\Money\Wallet\Repository\CurrencyRepository;
use App\Model\Money\Wallet\Repository\WalletRepository;
use App\Model\Money\Transaction\Entity\Transaction\Type;
use App\Model\Money\Transaction\Entity\Transaction\Cause;
use App\Model\Money\Transaction\Entity\Transaction\Transaction;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class Handler
{
    private $flusher;
    private $walletRepository;
    private $currencyRepository;
    private $transactionRepository;

    public function __construct(
        WalletRepository $walletRepository,
        CurrencyRepository $currencyRepository,
        TransactionRepository $transactionRepository,
        Flusher $flusher
    )
    {
        $this->walletRepository = $walletRepository;
        $this->flusher = $flusher;
        $this->currencyRepository = $currencyRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function handle(Command $command): void
    {
        $wallet = $this->walletRepository->get($command->walletId);
        $currency = $this->currencyRepository->getCode($command->currency);
        $type = new Type($command->type);
        $cause = new Cause($command->cause);

        if ($type->isCredit()) {
            $wallet->minus($command->amount, $currency);
        } elseif ($type->isDebit()) {
            $wallet->plus($command->amount, $currency);
        } else {
            throw new \DomainException('Unknown transaction type');
        }

        $transaction = Transaction::create($wallet, $type, $currency, $cause, $command->amount);
        $this->transactionRepository->add($transaction);

        $this->flusher->flush();
    }
}