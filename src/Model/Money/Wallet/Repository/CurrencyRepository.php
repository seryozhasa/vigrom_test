<?php

declare(strict_types=1);

namespace App\Model\Money\Wallet\Repository;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class CurrencyRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Currency::class);
    }

    public function get(int $id): Currency
    {
        /** @var Currency $currency */
        if (!$currency = $this->repo->find($id)) {
            throw new EntityNotFoundException('Currency is not found.');
        }
        return $currency;
    }

    public function getCode(string $code): Currency
    {
        /** @var Currency $currency */
        if (!$currency = $this->repo->findOneBy(['code' => mb_strtoupper($code)])) {
            throw new EntityNotFoundException('Currency is not found.');
        }
        return $currency;
    }

    public function add(Currency $currency): void
    {
        $this->em->persist($currency);
    }

}