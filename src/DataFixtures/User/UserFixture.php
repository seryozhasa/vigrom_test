<?php

declare(strict_types=1);

namespace App\DataFixtures\User;

use App\Model\User\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\DataFixtures\Money\Wallet\WalletFixture;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class UserFixture extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $walletRub = $this->getReference(WalletFixture::REFERENCE_RUB);
        $walletUsd = $this->getReference(WalletFixture::REFERENCE_USD);

        $user = User::create('user #1', $walletRub);
        $manager->persist($user);

        $user = User::create('user #2', $walletUsd);
        $manager->persist($user);

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
        ];
    }
}