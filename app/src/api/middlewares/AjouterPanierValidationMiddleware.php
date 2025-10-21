<?php

namespace charlymatloc\api\middlewares;

use charlymatloc\api\dto\InputPanierDTO;
use DateTime;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Slim\Exception\HttpBadRequestException;
use Slim\Routing\RouteContext;

class AjouterPanierValidationMiddleware {
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $next) : ResponseInterface {

        $route_params = RouteContext::fromRequest($request)
            ->getRoute()
            ->getArguments() ?? null;

        $data = $request->getQueryParams();
        $data["id_outil"] = $route_params["id_outil"];

        $data["quantite"] = intval($data["quantite"]);

        try {
            v::key('id_user', v::stringType()->notEmpty())
                ->key('id_outil', v::stringType()->notEmpty())
                ->key('quantite', v::intType()->notEmpty())
                ->key('date_reservation', v::stringType()->notEmpty())
            ->assert($data);

        } catch (NestedValidationException $e) {
            throw new HttpBadRequestException($request, "Invalid data: " . $e->getFullMessage(), $e);
        }

        //vérification format des datetime
        //foreach (['date_heure_debut', 'date_heure_fin'] as $datetime) {
        foreach (['date_reservation'] as $datetime) {
            $data[$datetime] = urldecode($data[$datetime]);
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $data[$datetime]);
            if (!$date || $date->format('Y-m-d H:i:s') !== $data[$datetime]) {
                throw new HttpBadRequestException($request, "Le champ $datetime doit etre au format Y-m-d H:i:s");
            }
        }

        $panierDTO = new InputPanierDTO($data);
        $request = $request->withAttribute('panier_dto', $panierDTO);

        return $next->handle($request);
    }
}