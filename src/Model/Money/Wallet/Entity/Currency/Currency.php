<?php

declare(strict_types=1);

namespace App\Model\Money\Wallet\Entity\Currency;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="wallet_currencies", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"code"}),
 * }))
 * @author sergey seryozhasafonov@gmail.com
 */
class Currency
{
    public const RUB = 'RUB';
    public const USD = 'USD';

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * Количество рублей за данную валюту
     * @var float
     * @ORM\Column(type="float")
     */
    private $value;

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

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function isRUB(): bool
    {
        return $this->equalCode(self::RUB);
    }

    public function isUSD(): bool
    {
        return $this->equalCode(self::USD);
    }

    public function equalCode(string $code): bool
    {
        return $this->code === $code;
    }
}