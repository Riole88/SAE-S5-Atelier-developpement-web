<?php

namespace charlymatloc\api\actions;

use charlymatloc\api\dto\auth\CredentialsDTO;
use charlymatloc\api\providers\auth\AuthnProviderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

readonly class LoginAction
{
    public function __construct(
        private AuthnProviderInterface $authnProvider
    ) {}

    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $email = $data['email'];
        $password = $data['password'];

        if (empty($email) || empty($password)) {
            throw new \InvalidArgumentException("Email ou mot de passe non fourni");
        }

        $credentials = new CredentialsDTO($email, $password);
        $authDTO = $this->authnProvider->signin($credentials);

        $res = [
            'payload' => [
                'access_token'  => $authDTO->getAccessToken(),
                'refresh_token' => $authDTO->getRefreshToken(),
            ],
            'profile' => [
                'id' => $authDTO->getId(),
                'email' => $authDTO->getEmail(),
                'role' => $authDTO->getRole(),
            ]
        ];

        $response->getBody()->write(json_encode($res, JSON_UNESCAPED_UNICODE));

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus(200);
    }
}