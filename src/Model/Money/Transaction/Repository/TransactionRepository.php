<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Repository;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use App\Model\Money\Transaction\Entity\Transaction\Transaction;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class TransactionRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Transaction::class);
    }

    public function get(int $id): Transaction
    {
        /** @var Transaction $transaction */
        if (!$transaction = $this->repo->find($id)) {
            throw new EntityNotFoundException('Transaction is not found.');
        }
        return $transaction;
    }

    public function add(Transaction $transaction): void
    {
        $this->em->persist($transaction);
    }

}