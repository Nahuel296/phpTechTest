<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\UserId;

class UserIdType extends StringType
{
    public function getName(): string
    {
        return 'userId';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserId
    {
        if ($value === null) {
            return null;
        }

        return new UserId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return $value->getId();
    }
}