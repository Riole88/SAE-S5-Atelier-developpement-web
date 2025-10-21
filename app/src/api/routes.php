<?php
declare(strict_types=1);

use Slim\App;
use charlymatloc\api\actions\OutilAction;
use charlymatloc\api\actions\OutilsAction;

return function(App $app): App {

    //    GET
    $app->get('/outils', OutilsAction::class);
    $app->get('/outils/{id_outil}', OutilAction::class);
    return $app;
};