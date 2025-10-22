<?php

use charlymatloc\api\actions\PanierAction;
use charlymatloc\api\actions\RegisterAction;
use charlymatloc\api\actions\ReserverOutilAction;
use charlymatloc\api\actions\OutilAction;
use charlymatloc\core\application\usecases\auth\AuthnServiceInterface;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use Psr\Container\ContainerInterface;
use charlymatloc\api\actions\OutilsAction;

return [
    OutilsAction::class => function (ContainerInterface $c) {
        return new OutilsAction($c->get(ServiceOutilInterface::class));
    },
    OutilAction::class => function (ContainerInterface $c) {
        return new OutilAction($c->get(ServiceOutilInterface::class));
    },
    ReserverOutilAction::class => function (ContainerInterface $c) {
        return new ReserverOutilAction($c->get(ServicePanierInterface::class));
    },
    PanierAction::class => function (ContainerInterface $c) {
        return new PanierAction($c->get(ServicePanierInterface::class));
    },
    RegisterAction::class => function (ContainerInterface $c) {
        return new RegisterAction($c->get(AuthnServiceInterface::class));
    }
];