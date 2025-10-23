<?php

namespace charlymatloc\core\domain\exceptions;

class UnauthorizedException extends \Exception
{
    public function __construct(string $message = "Non autorisé", int $code = 401)
    {
        parent::__construct($message, $code);
    }
}