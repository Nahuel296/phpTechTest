<?php

namespace Application\User\DTO;

class UserResponseDTO
{
    public function __construct(
        public string $id,
        public string $email,
        public string $createdAt
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
        ];
    }
}
