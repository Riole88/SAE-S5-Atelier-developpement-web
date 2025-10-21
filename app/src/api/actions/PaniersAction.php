<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PaniersAction {
    private ServicePanierInterface $servicePanier;

    public function __construct(ServicePanierInterface $servicePanier) {
        $this->servicePanier = $servicePanier;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
//        try {
            $res = $this->servicePanier->getPaniers();
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
//        } catch (\Exception) {
//            throw new \Exception("Erreur lors de la récupération de la liste des outils.");
//        }
    }
}