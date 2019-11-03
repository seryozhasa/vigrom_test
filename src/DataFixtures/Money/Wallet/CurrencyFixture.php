<?php

declare(strict_types=1);

namespace App\DataFixtures\Money\Wallet;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Model\Money\Wallet\Entity\Currency\Currency;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class CurrencyFixture extends Fixture
{
    public const REFERENCE_RUB = 'currency_rub';
    public const REFERENCE_USD = 'currency_usd';

    public function load(ObjectManager $manager)
    {
        $rub = Currency::createRUB();
        $rub->setValue(1.0);
        $manager->persist($rub);
        $this->setReference(self::REFERENCE_RUB, $rub);

        $usd = Currency::createUSD();
        $usd->setValue(65.0);
        $manager->persist($usd);
        $this->setReference(self::REFERENCE_USD, $usd);

        $manager->flush();
    }
}