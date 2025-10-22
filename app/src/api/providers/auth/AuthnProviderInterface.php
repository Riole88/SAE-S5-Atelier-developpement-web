<?php

namespace charlymatloc\api\providers\auth;

use charlymatloc\api\dto\auth\AuthDTO;
use charlymatloc\api\dto\auth\CredentialsDTO;

interface AuthnProviderInterface
{
    //public function register(CredentialsDTO $credentials, int $role): void;
    public function signin(CredentialsDTO $credentials): AuthDTO;
    public function refresh(string $token): AuthDTO;
    public function getSignedInUser(string $token): AuthDTO;
}