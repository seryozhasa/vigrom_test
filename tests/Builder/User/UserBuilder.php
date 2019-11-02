<?php

declare(strict_types=1);

namespace App\Tests\Builder\User;

use App\Model\User\Entity\User\User;
use App\Model\Money\Wallet\Entity\Wallet\Wallet;
use App\Tests\Builder\Money\Wallet\WalletBuilder;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class UserBuilder
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var Wallet
     */
    private $wallet;

    public function __construct()
    {
        $this->username = 'username';
        $this->wallet = (new WalletBuilder)->build();
    }

    public function withUsername(string $username)
    {
        $clone = clone $this;
        $clone->username = $username;
        return $clone;
    }

    public function withWallet(Wallet $wallet)
    {
        $clone = clone $this;
        $clone->wallet = $wallet;
        return $clone;
    }

    public function build(): User
    {
        return User::create($this->username, $this->wallet);
    }
}