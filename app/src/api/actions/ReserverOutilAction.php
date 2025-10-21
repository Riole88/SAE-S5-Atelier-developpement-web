<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ReserverOutilAction {
    private ServicePanierInterface $servicePanier;

    public function __construct(ServicePanierInterface $servicePanier) {
        $this->servicePanier = $servicePanier;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $panier_dto = $request->getAttribute('panier_dto') ?? null;

            if(is_null($panier_dto)) {
                throw new Exception("Erreur récupération DTO de création d'un rendez-vous");
            }

//            $queryParams = $request->getQueryParams();
//            $date_debut = $queryParams['date_debut'] ?? null;
//            $date_fin = $queryParams['date_fin'] ?? null;
//            if(empty($date_debut)) {
//                throw new \Exception("Saisissez une date de debut.");
//            }
//            if(empty($date_fin)) {
//                throw new \Exception("Saisissez une date de fin.");
//            }
            $res = $this->servicePanier->ajouterPanier($panier_dto);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}