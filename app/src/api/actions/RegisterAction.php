<?php
namespace charlymatloc\api\actions;

use charlymatloc\core\application\usecases\auth\AuthnServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RegisterAction {
    private AuthnServiceInterface $serviceAuthn;
    public function __construct(AuthnServiceInterface $serviceAuthn){
        $this->serviceAuthn = $serviceAuthn;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $user_dto = $request->getAttribute('user_dto') ?? null;

            if(is_null($user_dto)) {
                throw new \Exception("Erreur récupération DTO de création d'un rendez-vous");
            }

            $res = $this->serviceAuthn->register($user_dto);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");

        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la création du compte.");
        } catch(\Throwable $e){
            throw new \Exception($e->getMessage());
        }
    }
}
