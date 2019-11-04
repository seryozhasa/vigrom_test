<?php

declare(strict_types=1);

namespace App\DataFixtures\Money\Wallet;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Model\Money\Wallet\Entity\Wallet\Wallet;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class WalletFixture extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_RUB = 'wallet_rub';
    public const REFERENCE_USD = 'wallet_usd';

    public function load(ObjectManager $manager)
    {
        $wallet_rub = Wallet::create($this->getReference(CurrencyFixture::REFERENCE_RUB), 10000.0);
        $manager->persist($wallet_rub);
        $this->setReference(self::REFERENCE_RUB, $wallet_rub);

        $wallet_usd = Wallet::create($this->getReference(CurrencyFixture::REFERENCE_USD), 10000.0);
        $manager->persist($wallet_usd);
        $this->setReference(self::REFERENCE_USD, $wallet_usd);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CurrencyFixture::class,
        ];
    }
}