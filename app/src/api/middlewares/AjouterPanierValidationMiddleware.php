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

        $profile = $request->getAttribute('profile');
        if (!$profile) {
            throw new HttpBadRequestException($request, "Utilisateur non authentifié");
        }


        $body = json_decode($request->getBody()->getContents(), true);

        if (!$body) {
            throw new HttpBadRequestException($request, "Corps de la requête invalide ou vide");
        }

        $data = [
            'id_user' => $profile->id,
            'id_outil' => $route_params["id_outil"] ?? null,
            'quantite' => isset($body['quantite']) ? intval($body['quantite']) : null,
            'date_reservation' => $body['date_reservation'] ?? null
        ];

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
        $data['date_reservation'] = urldecode($data['date_reservation']);
        $date = DateTime::createFromFormat('Y-m-d', $data['date_reservation']);
        if (!$date || $date->format('Y-m-d') !== $data['date_reservation']) {
            throw new HttpBadRequestException($request, "Le champ date_reservation doit être au format Y-m-d H:i:s(ex: 2025-12-04)");
        }

        $panierDTO = new InputPanierDTO($data);
        $request = $request->withAttribute('panier_dto', $panierDTO);

        return $next->handle($request);
    }
}