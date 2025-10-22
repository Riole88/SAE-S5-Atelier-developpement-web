<?php
declare(strict_types=1);

use charlymatloc\api\actions\RegisterAction;
use charlymatloc\api\middlewares\CorsMiddleware;
use charlymatloc\api\actions\PanierAction;
use charlymatloc\api\actions\ReserverOutilAction;
use charlymatloc\api\middlewares\AjouterPanierValidationMiddleware;
use charlymatloc\api\middlewares\EnregistrerUtilisateurMiddleware;
use Slim\App;
use charlymatloc\api\actions\OutilAction;
use charlymatloc\api\actions\OutilsAction;

return function(App $app): App {
    $app->add(CorsMiddleware::class);

    //    GET
    $app->get('/outils', OutilsAction::class);
    $app->get('/outils/{id_outil}', OutilAction::class);
    $app->get('/paniers/{id_user}', PanierAction::class);


    //     POST
    $app->post('/outils/{id_outil}/reserver', ReserverOutilAction::class)
        ->add(new AjouterPanierValidationMiddleware());
    //localhost:6080/outils/d8cf91f1-45f1-4d62-96a0-fda5c1e07f19/reserver?id_user=e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1&quantite=2&date_reservation=2025-12-04
    $app->post('/login', RegisterAction::class)
        ->add(new EnregistrerUtilisateurMiddleware());

    return $app;
};