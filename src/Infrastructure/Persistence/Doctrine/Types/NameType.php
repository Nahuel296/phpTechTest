<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\Name;

class NameType extends StringType
{
    public function getName(): string
    {
        return 'name';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Name
    {
        if ($value === null) {
            return null;
        }

        return new Name($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return $value->getName();
    }
}