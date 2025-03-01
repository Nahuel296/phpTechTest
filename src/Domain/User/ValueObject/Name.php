<?php

namespace Domain\User\ValueObject;

use Domain\User\Exception\InvalidNameException;

class Name
{
    private string $name;

    public function __construct(string $name)
    {
        if (empty(trim($name))) {
            throw new InvalidNameException("Name cannot be empty.");
        }
        $this->name = trim($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}