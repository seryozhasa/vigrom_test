<?php

declare(strict_types=1);

namespace App\Model\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Money\Wallet\Entity\Wallet\Wallet;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_users", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"username"}),
 * })
 * @author sergey seryozhasafonov@gmail.com
 */
class User
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $username;

    /**
     * @var Wallet
     * @ORM\OneToOne(targetEntity="App\Model\Money\Wallet\Entity\Wallet\Wallet")
     */
    private $wallet;

    private function __construct(string $username, Wallet $wallet)
    {
        $this->username = $username;
        $this->wallet = $wallet;
    }

    public static function create(string $username, Wallet $wallet): self
    {
        return new self($username, $wallet);
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }
}