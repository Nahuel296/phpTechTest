<?php

namespace Infrastructure\Persistence\Doctrine\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Domain\User\ValueObject\Password;

class PasswordType extends StringType
{
    public function getName(): string
    {
        return 'password';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Password
    {
        if ($value === null) {
            return null;
        }

        return new Password($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        return (string) $value;
    }
}