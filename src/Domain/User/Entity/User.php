<?php

namespace Domain\User\Entity;

use DateTimeImmutable;
use Domain\User\ValueObject\UserId;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Password;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'userId', length: 36, unique: true)]
    private UserId $id;

    #[ORM\Column(type: 'name', length: 255)]
    private Name $name;

    #[ORM\Column(type: 'email', length: 255, unique: true)]
    private Email $email;

    #[ORM\Column(type: 'password', length: 255)]
    private Password $password;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    public function __construct(UserId $id, Name $name, Email $email, Password $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
