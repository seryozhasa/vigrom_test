<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Entity\Transaction;

use Webmozart\Assert\Assert;

/**
 * @author sergey seryozhasafonov@gmail.com
 */
class Type
{
    public const DEBIT = 'debit';
    public const CREDIT = 'credit';

    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        Assert::oneOf($name, [self::DEBIT, self::CREDIT]);
        $this->name = $name;
    }

    public static function createDebit(): self
    {
        return new self(self::DEBIT);
    }

    public static function createCredit(): self
    {
        return new self(self::CREDIT);
    }

    public function isDebit(): bool
    {
        return $this->name === self::DEBIT;
    }

    public function isCredit(): bool
    {
        return $this->name === self::CREDIT;
    }

    public function getName(): string
    {
        return $this->name;
    }

}