<?php

namespace charlymatloc\core\application\usecases\auth;

use charlymatloc\api\dto\InputUserDTO;
use Faker\Core\Uuid;
use charlymatloc\api\dto\auth\AuthDTO;
use charlymatloc\api\dto\auth\CredentialsDTO;

interface AuthnServiceInterface{

    //public function createUser(CredentialsDTO $credentials, int $role): string;

    public function byCredentials(CredentialsDTO $credentials): AuthDTO;

    public function register(InputUserDTO $userDto): array;
}