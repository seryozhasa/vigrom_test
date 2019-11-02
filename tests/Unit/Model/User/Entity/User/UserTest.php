<?php

declare(strict_types=1);

namespace App\Tests\Unit\Model\User\Entity\User;

use App\Tests\Builder\Money\Wallet\WalletBuilder;
use App\Tests\Builder\User\UserBuilder;
use PHPUnit\Framework\TestCase;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class UserTest extends TestCase
{
    public function testGetWallet(): void
    {
        $wallet = (new WalletBuilder())->build();
        $user = (new UserBuilder())->withWallet($wallet)->build();
        self::assertEquals($wallet, $user->getWallet());
    }
}