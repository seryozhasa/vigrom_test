<?php

declare(strict_types=1);

namespace App\DataFixtures\Money\Transaction;

use App\DataFixtures\Money\Wallet\CurrencyFixture;
use App\DataFixtures\Money\Wallet\WalletFixture;
use App\Model\Money\Transaction\Entity\Transaction\Cause;
use App\Model\Money\Wallet\Entity\Currency\Currency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Model\Money\Transaction\Entity\Transaction\Type;
use App\Model\Money\Transaction\Entity\Transaction\Transaction;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class TransactionFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $types = [Type::createDebit(), Type::createCredit()];
        $currencies = [$this->getReference(CurrencyFixture::REFERENCE_RUB), $this->getReference(CurrencyFixture::REFERENCE_USD)];
        $wallets = [$this->getReference(WalletFixture::REFERENCE_RUB), $this->getReference(WalletFixture::REFERENCE_USD)];
        $causes = [Cause::create(Cause::REFUND), Cause::create(Cause::STOCK)];

        $time = new \DateTimeImmutable('2019-01-01');
        $now = new \DateTimeImmutable();
        $interval = new \DateInterval('PT4H');
        for ($time; $time <= $now; $time = $time->add($interval)) {
            $type = $types[array_rand($types)];
            $wallet = $wallets[array_rand($wallets)];
            $cause = $causes[array_rand($causes)];
            $currency = $currencies[array_rand($currencies)];
            $transaction = Transaction::create($wallet, $type, $currency, $cause, (float) rand(10, 5000), $time);
            $manager->persist($transaction);
        }
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
            WalletFixture::class,
            CurrencyFixture::class,
        ];
    }
}