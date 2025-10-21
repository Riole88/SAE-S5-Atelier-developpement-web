<?php

use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use charlymatloc\core\application\usecases\ServiceOutil;
use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use charlymatloc\infra\repositories\PDOOutilRepository;
use Psr\Container\ContainerInterface;

return [
    // SERVICES
    OutilRepositoryInterface::class => function (ContainerInterface $c) {
        return new PDOOutilRepository($c->get("charlymatloc.pdo"));
    },
    ServiceOutilInterface::class => function (ContainerInterface $c) {
        return new ServiceOutil($c->get(OutilRepositoryInterface::class));
    },
];

