<?php

declare(strict_types=1);

namespace Tests\Domain\User\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\User\ValueObject\Password;
use Domain\User\Exception\WeakPasswordException;

class PasswordTest extends TestCase
{
    public function test_valid_password(): void
    {
        $password = new Password('StrongP@ssw0rd');
        $this->assertNotEmpty($password->getHashedValue());
    }

    public function test_weak_password_throws_exception(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('weak');
    }
}
