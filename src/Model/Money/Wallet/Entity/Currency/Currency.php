<?php

declare(strict_types=1);

namespace App\Model\Money\Wallet\Entity\Currency;

use Webmozart\Assert\Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet_currencies")
 * @author sergey seryozhasafonov@gmail.com
 */
class Currency
{
    public const RUB = 'RUB';
    public const USD = 'USD';

    /**
     * @var int
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    private function __construct(string $code)
    {
        Assert::oneOf($code, [self::RUB, self::USD]);
        $this->code = $code;
    }

    public static function create(string $code): self
    {
        return new self(mb_strtoupper($code));
    }

    public static function createRUB(): self
    {
        return new self(self::RUB);
    }

    public static function createUSD(): self
    {
        return new self(self::USD);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    public function isRUB(): bool
    {
        return $this->code === self::RUB;
    }

    public function isUSD(): bool
    {
        return $this->code === self::USD;
    }

    public function equalCode(string $code): bool
    {
        return $this->code === $code;
    }
}