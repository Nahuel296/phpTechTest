<?php

namespace Tests\Infrastructure\Persistence;

use PHPUnit\Framework\TestCase;
use Infrastructure\Persistence\Doctrine\DoctrineUserRepository;
use Domain\User\Entity\User;
use Domain\User\ValueObject\UserId;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Password;
use Infrastructure\Persistence\Doctrine\Types\NameType;
use Infrastructure\Persistence\Doctrine\Types\UserIdType;
use Infrastructure\Persistence\Doctrine\Types\EmailType;
use Infrastructure\Persistence\Doctrine\Types\PasswordType;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\DBAL\Types\Type;

class DoctrineUserRepositoryTest extends TestCase
{
    private DoctrineUserRepository $repository;
    private EntityManager $entityManager;
    private int $emailCounter = 0;

    protected function setUp(): void
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../../../src/Domain/User"],
            isDevMode: true
        );

        $connectionParams = [
            'dbname' => 'myapp',
            'user' => 'user',
            'password' => 'password',
            'host' => 'mysql_db',
            'driver' => 'pdo_mysql',
        ];

        $connection = DriverManager::getConnection($connectionParams, $config);
        $this->entityManager = new EntityManager($connection, $config);

        if (!Type::hasType('name')) {
            Type::addType('name', NameType::class);
        }
        if (!Type::hasType('userId')) {
            Type::addType('userId', UserIdType::class);
        }
        if (!Type::hasType('email')) {
            Type::addType('email', EmailType::class);
        }
        if (!Type::hasType('password')) {
            Type::addType('password', PasswordType::class);
        }

        $this->cleanDatabase();

        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($this->entityManager->getMetadataFactory()->getAllMetadata());

        $this->repository = new DoctrineUserRepository($this->entityManager);
    }

    protected function cleanDatabase(): void
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }

    public function test_save_and_find_user()
    {
        $uuid = Uuid::uuid4()->toString();
        $uuidWithoutHyphens = str_replace('-', '', $uuid);
        $email = "test" . $this->emailCounter++ . "@example.com";
        $user = new User(new UserId($uuidWithoutHyphens), new Name('John Doe'), new Email($email), new Password('SecureP@ss123'));
        $this->repository->save($user);

        $foundUser = $this->repository->findByEmail($email);
        $this->assertNotNull($foundUser);
        $this->assertEquals($email, $foundUser->getEmail());
    }
}
