<?php

declare(strict_types=1);

namespace App\Service\Currency\Quote;

use App\Model\Flusher;
use Doctrine\ORM\EntityManagerInterface;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
abstract class Quote
{
    /**
     * @var Currency[]|null
     */
    protected $data;
    private $flusher;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, Flusher $flusher)
    {
        $this->data = $this->load();
        $this->entityManager = $entityManager;
        $this->flusher = $flusher;
    }

    /**
     * Возвращает массив данных с валютами и новыми котировками
     * @return Currency[]|null
     */
    abstract function load(): ?array;

    /**
     * Обновляет value у сущностей валют.
     * В данной реализации обновляется только USD
     */
    public function update(): void
    {
        if (is_null($this->data)) {
            return;
        }
        foreach ($this->data as $currency) {
            if ($currency->isUSD()) {
                /** @var Currency $currencyInDatabase */
                $currencyInDatabase = $this->entityManager->getRepository(Currency::class)->findOneBy(['code' => $currency->getCode()]);
                if (!$currencyInDatabase) {
                    $currencyInDatabase = $currency;
                } else {
                    $currencyInDatabase->setValue($currency->getValue());
                }
                $this->entityManager->persist($currencyInDatabase);
                break;
            }
        }
        $this->flusher->flush();
    }
}