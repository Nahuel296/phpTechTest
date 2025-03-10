<?php

namespace Domain\User\Repository;

use Domain\User\Entity\User;
use Domain\User\ValueObject\UserId;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function findByEmail(string $email): ?User;
    public function delete(UserId $id): void;
}
