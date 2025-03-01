<?php

declare(strict_types=1);

namespace Tests\Domain\User\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\User\ValueObject\Email;
use Domain\User\Exception\InvalidEmailException;

class EmailTest extends TestCase
{
    public function test_valid_email(): void
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->getEmail());
    }

    public function test_invalid_email_throws_exception(): void
    {
        $this->expectException(InvalidEmailException::class);
        new Email('invalid-email');
    }
}
