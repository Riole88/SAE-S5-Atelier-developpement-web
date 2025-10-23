<?php
declare(strict_types=1);

use charlymatloc\api\actions\LoginAction;
use charlymatloc\api\actions\RegisterAction;
use charlymatloc\api\middlewares\AuthMiddleware;
use charlymatloc\api\middlewares\CorsMiddleware;
use charlymatloc\api\actions\PanierAction;
use charlymatloc\api\actions\ReserverOutilAction;
use charlymatloc\api\actions\ReservationsAction;
use charlymatloc\api\middlewares\AjouterPanierValidationMiddleware;
use charlymatloc\api\middlewares\EnregistrerUtilisateurMiddleware;
use charlymatloc\api\middlewares\ErreurMiddleware;
use Slim\App;
use charlymatloc\api\actions\OutilAction;
use charlymatloc\api\actions\OutilsAction;

return function(App $app): App {

    $jwtSecret = $_ENV['JWT_SECRET'];

    //gestion du CORS
    $app->add(CorsMiddleware::class);

    //attrape toutes les erreurs global
    $app->add(ErreurMiddleware::class);

    // routes publiques
    $app->post('/login', LoginAction::class );
    $app->get('/outils', OutilsAction::class);
    $app->get('/outils/{id_outil}', OutilAction::class);
    $app->post('/register', RegisterAction::class)
        ->add(new EnregistrerUtilisateurMiddleware());


    // routes protégées
    $app->get('/paniers/{id_user}', PanierAction::class)
        ->add(new AuthMiddleware($jwtSecret));
    $app->get('/reservations/{id_user}', ReservationsAction::class)
        ->add(new AuthMiddleware($jwtSecret));
    $app->post('/outils/{id_outil}/reserver', ReserverOutilAction::class)
        ->add(new AjouterPanierValidationMiddleware())
        ->add(new AuthMiddleware($jwtSecret));
    // TEST : localhost:6080/outils/d8cf91f1-45f1-4d62-96a0-fda5c1e07f19/reserver?id_user=e3a5cf93-7b9c-40ac-a0c5-2b8b2b5e93b1&quantite=2&date_reservation=2025-12-04

    return $app;
};