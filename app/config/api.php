<?php

use charlymatloc\api\actions\OutilAction;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use Psr\Container\ContainerInterface;
use charlymatloc\api\actions\OutilsAction;

return [
    OutilsAction::class => function (ContainerInterface $c) {
        return new OutilsAction($c->get(ServiceOutilInterface::class));
    },
    OutilAction::class => function (ContainerInterface $c) {
        return new OutilAction($c->get(ServiceOutilInterface::class));
    }
];