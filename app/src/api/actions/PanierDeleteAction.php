<?php

namespace charlymatloc\api\actions;

use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PanierDeleteAction {
    private ServicePanierInterface $servicePanier;

    public function __construct(ServicePanierInterface $servicePanier) {
        $this->servicePanier = $servicePanier;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $id_user = $args['id_user'] ?? null;
            $id_outil = $args['id_outil'] ?? null;

            if (empty($id_user) || empty($id_outil)) {
                throw new \Exception("Paramètres manquants : id_user et id_outil sont requis");
            }

            $res = $this->servicePanier->supprimerDuPanier($id_user, $id_outil);

            $response->getBody()->write(json_encode($res));
            return $response
                ->withHeader("Content-Type", "application/json")
                ->withStatus($res['success'] ? 200 : 400);

        } catch (\Exception $e) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]));
            return $response
                ->withHeader("Content-Type", "application/json")
                ->withStatus(500);
        }
    }
}
