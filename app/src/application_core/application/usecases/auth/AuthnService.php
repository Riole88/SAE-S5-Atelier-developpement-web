<?php

namespace charlymatloc\core\application\usecases\auth;

use charlymatloc\api\dto\InputUserDTO;
use charlymatloc\api\dto\auth\AuthDTO;
use charlymatloc\api\dto\auth\CredentialsDTO;
use charlymatloc\core\domain\exceptions\EntityNotFoundException;
use charlymatloc\infra\repositories\interface\UserRepositoryInterface;

class AuthnService implements AuthnServiceInterface
{
    public UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function byCredentials(CredentialsDTO $credentials): AuthDTO
    {
        // Vérification des champs
        if (empty($credentials->getEmail()) || empty($credentials->getPassword())) {
            throw new \InvalidArgumentException("Email et mot de passe sont requis.");
        }

        // Recherche de l'utilisateur par email
        try {
            $user = $this->userRepository->findByEmail($credentials->getEmail());
        } catch (EntityNotFoundException $e) {
            throw new \RuntimeException("Utilisateur introuvable pour l'email fourni.");
        }

        // Vérification du mot de passe
        if(!password_verify($credentials->getPassword(), $user->password_hash)){
            throw new \RuntimeException("Mot de passe incorrect.");
        }


        // Création du DTO d’authentification
        return new AuthDTO(
            id: $user->id,
            email: $user->email,
            role: $user->role,
        );
    }

    public function register(InputUserDTO $userDto): array {
        try {
            $passwordhash = password_hash($userDto->password, PASSWORD_BCRYPT);
            $credential = new CredentialsDTO($userDto->email, $passwordhash);

            $this->userRepository->saveUser($credential);
        } catch (\Exception $e) {
            return [
                'status' => $e->getCode(),
                'success' => false,
                "message" => $e->getMessage()
            ];
        }
        return [
            'status' => 201,
            'success' => true,
            "message" => "Utilisateur ajouté avec succés."
        ];
    }
}