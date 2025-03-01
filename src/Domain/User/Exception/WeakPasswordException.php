<?php

namespace Domain\User\Exception;

use Exception;

class WeakPasswordException extends Exception
{
    protected $message = "La contraseña proporcionada no es válida.";
}
