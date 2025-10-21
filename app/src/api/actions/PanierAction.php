<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PanierAction {
    private ServicePanierInterface $servicePanier;

    public function __construct(ServicePanierInterface $servicePanier) {
        $this->servicePanier = $servicePanier;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $id_user = $args['id_user'] ?? null;
            if(empty($id_user)) {
                throw new \Exception("Saisissez un id pour l'outil");
            }
            $res = $this->servicePanier->getPanier($id_user);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}