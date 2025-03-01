<?php

namespace Application\User\DTO;

class RegisterUserRequest
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
