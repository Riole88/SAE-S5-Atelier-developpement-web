<?php

namespace charlymatloc\core\domain\exceptions\authz;

class UnauthorizedException extends \Exception
{
    public function __construct(string $message = "Non autorisé", int $code = 401)
    {
        parent::__construct($message, $code);
    }
}