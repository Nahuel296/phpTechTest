<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Http\Controller;

use PHPUnit\Framework\TestCase;
use Infrastructure\Http\Controller\RegisterUserController;
use Application\User\UseCase\RegisterUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Application\User\DTO\UserResponseDTO;

class RegisterUserControllerTest extends TestCase
{
    public function test_register_user_successfully(): void
    {
        $mockUseCase = $this->createMock(RegisterUserUseCase::class);
        $mockUseCase->method('execute')->willReturn(new UserResponseDTO('123', 'test@example.com', '2024-02-26'));

        $controller = new RegisterUserController($mockUseCase);
        $request = new Request([], [], [], [], [], [], json_encode([
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'StrongP@ssw0rd'
        ]));

        $response = $controller->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('test@example.com', $data['email']);
    }
}
