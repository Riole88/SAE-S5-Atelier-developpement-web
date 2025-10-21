<?php

namespace charlymatloc\api\actions;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OutilAction {
    private OutilRepositoryInterface $serviceOutil;

    public function __construct(OutilRepositoryInterface $serviceOutil) {
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
            $res = $this->serviceOutil->findOutilById($id_outil);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception) {
            throw new \Exception("Erreur lors de la récupération de l'outil.");
        }
    }
}