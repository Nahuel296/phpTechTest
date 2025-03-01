<?php

namespace Domain\User\Exception;

use Exception;

class UserAlreadyExistsException extends Exception
{
    protected $message = "El usuario ya existe.";
}
