<?php

declare(strict_types=1);

namespace App\Model\Money\Transaction\Entity\Transaction;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class CauseType extends StringType
{
    public const NAME = 'transaction_cause';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Cause ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Cause($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
}