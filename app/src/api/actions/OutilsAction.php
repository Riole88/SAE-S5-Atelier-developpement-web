<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OutilsAction {
    private ServiceOutilInterface $serviceOutil;

    public function __construct(ServiceOutilInterface $serviceOutil) {
        $this->serviceOutil = $serviceOutil;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $res = $this->serviceOutil->getOutils();
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception) {
            throw new \Exception("Erreur lors de la récupération de la liste des outils.");
        } catch(\Throwable $e){
            throw new \Exception($e->getMessage());
        }
    }
}