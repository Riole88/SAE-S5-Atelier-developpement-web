<?php

namespace toubilib\api\providers\auth;

use toubilib\api\dto\auth\AuthDTO;
use toubilib\api\dto\auth\CredentialsDTO;

interface AuthnProviderInterface
{
    public function register(CredentialsDTO $credentials, int $role): void;
    public function signin(CredentialsDTO $credentials): AuthDTO;
    public function refresh(string $token): AuthDTO;
    public function getSignedInUser(string $token): AuthDTO;
}