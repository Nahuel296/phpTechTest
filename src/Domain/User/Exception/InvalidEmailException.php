<?php

namespace Domain\User\Exception;

use Exception;

class InvalidEmailException extends Exception
{
    protected $message = "El email proporcionado no es válido.";
}
