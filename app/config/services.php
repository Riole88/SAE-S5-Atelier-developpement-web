<?php

use charlymatloc\core\application\usecases\auth\AuthnService;
use charlymatloc\core\application\usecases\auth\AuthnServiceInterface;
use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use charlymatloc\core\application\usecases\interface\ServicePanierInterface;
use charlymatloc\core\application\usecases\ServiceOutil;
use charlymatloc\core\application\usecases\ServicePanier;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use charlymatloc\infra\repositories\interface\UserRepositoryInterface;
use charlymatloc\infra\repositories\PDOOutilRepository;
use Psr\Container\ContainerInterface;

return [
    // SERVICES
    ServiceOutilInterface::class => function (ContainerInterface $c) {
        return new ServiceOutil($c->get(OutilRepositoryInterface::class));
    },
    ServicePanierInterface::class => function (ContainerInterface $c) {
        return new ServicePanier($c->get(PanierRepositoryInterface::class));
    },
    AuthnServiceInterface::class => function (ContainerInterface $c) {
        return new AuthnService($c->get(UserRepositoryInterface::class));
    },
];

