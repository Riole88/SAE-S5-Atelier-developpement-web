<?php
declare(strict_types=1);

use toubilib\api\actions\GetAllPraticienAction;
use toubilib\api\actions\GetPatientDetailAction;
use toubilib\api\actions\GetRDVDetailsAction;
use toubilib\api\actions\PostAnnulerRDVAction;
use toubilib\api\actions\PostAuthAction;
use toubilib\api\actions\PostRDVCreerAction;
use toubilib\api\actions\SearchRDVPraticienAction;
use toubilib\api\actions\GetPraticienDetailAction;
use toubilib\api\middlewares\AuthnMiddleware;
use toubilib\api\middlewares\AuthzPatientMiddleware;
use toubilib\api\middlewares\AuthzPraticienMiddleware;
use toubilib\api\middlewares\CheckNewRDV;
use toubilib\api\providers\auth\AuthnProviderInterface;
use toubilib\core\application\usecases\authz\AuthzPatientService;
use toubilib\core\application\usecases\authz\AuthzPraticienService;

return function( \Slim\App $app):\Slim\App {


    /**
     * CORS : options pour les requêtes preflight
     */
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });
    return $app;
};