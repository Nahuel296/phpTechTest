<?php

namespace Domain\User\Exception;

use Exception;

class InvalidIdException extends Exception
{
    protected $message = "El id proporcionado no es válido.";
}
