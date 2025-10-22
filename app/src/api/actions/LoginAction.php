<?php

namespace charlymatloc\api\actions;

use charlymatloc\api\dto\auth\CredentialsDTO;
use charlymatloc\api\providers\auth\AuthnProviderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginAction
{
    public function __construct(
        private readonly AuthnProviderInterface $authnProvider
    )
    {}

    public function __invoke(Request $request, Response $response): Response
    {
        try {
            $data = $request->getParsedBody();
            $email = $data['email'] ?? '';
            $password_hash = $data['password'] ?? '';

            if (($email==='') OR ($password_hash==='')){
                throw new \Exception("Email ou mot de passe non fourni");
            }
            $credentials = new CredentialsDTO($data['email'], $data['password']);
            $resLogIn = $this->authnProvider->signin($credentials);

            $authDTO = $resLogIn[0];
            $profile = $resLogIn[1];
            $payload = [
                'access_token'  => $authDTO->accesToken,
                'refresh_token' => $authDTO->refreshToken,
            ];

            $res = [
                'payload' => $payload,
                'profile' => $profile
            ];

            $response->getBody()->write(json_encode($res, JSON_PRETTY_PRINT));

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);


        }catch (\Exception $e){
            $response->getBody()->write($e->getMessage());
            return $response->withStatus(400);
        }

    }
}



