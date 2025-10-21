<?php

use charlymatloc\core\application\usecases\interface\ServiceOutilInterface;
use Psr\Container\ContainerInterface;
use charlymatloc\api\actions\OutilsAction;

return [
    OutilsAction::class => function (ContainerInterface $c) {
        return new OutilsAction($c->get(ServiceOutilInterface::class));
    }
];