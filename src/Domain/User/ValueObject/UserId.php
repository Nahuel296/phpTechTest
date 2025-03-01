<?php

namespace Domain\User\ValueObject;

use Domain\User\Exception\InvalidIdException;

class UserId
{
    private string $id;

    public function __construct(string $id)
    {
        if (!preg_match('/^[a-f0-9]{32}$/', $id)) {
            throw new InvalidIdException("Invalid UUID format.");
        }
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
