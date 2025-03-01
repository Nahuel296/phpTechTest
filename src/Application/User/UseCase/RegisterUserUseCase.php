<?php

namespace Application\User\UseCase;

use Domain\User\User;
use Domain\User\UserId;
use Domain\User\Email;
use Domain\User\Password;
use Domain\User\UserRepositoryInterface;
use Domain\User\Event\UserRegisteredEvent;

class RegisterUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(string $name, string $email, string $password)
    {
        if ($this->repository->findByEmail($email)) {
            throw new UserAlreadyExistsException("The email is already in use.");
        }

        $user = new User(new UserId(uniqid()), new Name($name), new Email($email), new Password($password));
        $this->repository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->eventDispatcher->dispatch($event);
    }
}
