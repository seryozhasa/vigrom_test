<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Repository;

use App\Model\EntityNotFoundException;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
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

    public function getRefundLastWeek()
    {
        $connection = DriverManager::getConnection(['url' => $_ENV['DATABASE_URL']], new Configuration());
        return $connection->query('
            SELECT 
                sum(t.amount), 
                c.code 
            FROM transactions t 
                INNER JOIN public.wallet_currencies c 
                    ON t.currency_id=c.id 
            WHERE 
                date BETWEEN NOW() - INTERVAL \'1 week\' AND 
                NOW() AND 
                cause=\'refund\' GROUP BY currency_id, c.code
')->fetchAll();

    }

    public function add(Transaction $transaction): void
    {
        $this->em->persist($transaction);
    }

}