<?php

namespace charlymatloc\api\actions;
use charlymatloc\core\application\usecases\interface\ServiceReservationInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ReservationsAction {
    private ServiceReservationInterface $serviceReservation;

    public function __construct(ServiceReservationInterface $serviceReservation) {
        $this->serviceReservation = $serviceReservation;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $id_user = $args['id_user'] ?? null;
            if(empty($id_user)) {
                throw new \Exception("Saisissez un id pour l'utilisateur");
            }
            $res = $this->serviceReservation->getReservations($id_user);
            $response->getBody()->write(json_encode($res));
            return $response->withHeader("Content-Type", "application/json");
        } catch (\Exception $e) {
            throw new \Exception("Erreur lors de la recuperation des reservations : " . $e->getMessage());
        } catch(\Throwable $e){
            throw new \Exception($e->getMessage());
        }
    }
}