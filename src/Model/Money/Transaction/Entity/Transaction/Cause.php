<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Entity\Transaction;

use Webmozart\Assert\Assert;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class Cause
{
    public const STOCK = 'stock';
    public const REFUND = 'refund';

    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        Assert::oneOf($name, [self::STOCK, self::REFUND]);
        $this->name = $name;
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function isStock(): bool
    {
        return $this->name === self::STOCK;
    }

    public function isRefund(): bool
    {
        return $this->name === self::REFUND;
    }

    public function getName(): string
    {
        return $this->name;
    }
}