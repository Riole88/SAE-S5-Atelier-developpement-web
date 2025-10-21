<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OutilAction {
    private ServiceOutilInterface $serviceOutil;

    public function __construct(ServiceOutilInterface $serviceOutil) {
        $this->serviceOutil = $serviceOutil;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $id_outil = $args['id_outil'] ?? null;
            if(empty($id_outil)) {
                throw new \Exception("Saisissez un id pour l'outil");
            }
            $res = $this->serviceOutil->getOutil($id_outil);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception) {
            throw new \Exception("Erreur lors de la récupération de l'outil.");
        }
    }
}