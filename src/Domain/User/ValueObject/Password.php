<?php

namespace Domain\User\ValueObject;

use Domain\User\Exception\WeakPasswordException;

class Password
{
    private string $hash;

    public function __construct(string $password)
    {
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z\d]/', $password)) {
            throw new WeakPasswordException("Password does not meet security requirements.");
        }
        $this->hash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function __toString(): string
    {
        return $this->hash;
    }
}
