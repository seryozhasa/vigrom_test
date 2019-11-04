<?php

declare(strict_types=1);

namespace App\Model\Money\Wallet\Repository;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use App\Model\Money\Wallet\Entity\Wallet\Wallet;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class WalletRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Wallet::class);
    }

    public function get(int $id): Wallet
    {
        /** @var Wallet $wallet */
        if (!$wallet = $this->repo->find($id)) {
            throw new EntityNotFoundException('Wallet is not found.');
        }
        return $wallet;
    }

    public function add(Wallet $wallet): void
    {
        $this->em->persist($wallet);
    }

}