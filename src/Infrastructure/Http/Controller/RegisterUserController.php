<?php

declare(strict_types=1);

namespace Infrastructure\Http\Controller;

use Application\User\UseCase\RegisterUserUseCase;
use Application\User\DTO\RegisterUserRequest;
use Application\User\DTO\UserResponseDTO;
use Domain\User\Exception\UserAlreadyExistsException;
use Domain\User\Exception\InvalidEmailException;
use Domain\User\Exception\WeakPasswordException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $registerRequest = new RegisterUserRequest(
                $data['name'],
                $data['email'],
                $data['password']
            );

            $userDTO = $this->registerUserUseCase->execute(
                $registerRequest->name,
                $registerRequest->email,
                $registerRequest->password
            );
            
            return new JsonResponse($userDTO->toArray(), JsonResponse::HTTP_CREATED);

        } catch (InvalidEmailException | WeakPasswordException | UserAlreadyExistsException $e) {
            return new JsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Internal Server Error'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
