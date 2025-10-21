<?php

use charlymatloc\infra\repositories\interface\OutilRepositoryInterface;
use charlymatloc\infra\repositories\PDOOutilRepository;
use charlymatloc\infra\repositories\interface\PanierRepositoryInterface;
use charlymatloc\infra\repositories\PDOPanierRepository;
use charlymatloc\infra\repositories\interface\CategorieRepositoryInterface;
use charlymatloc\infra\repositories\PDOCategorieRepository;
use charlymatloc\infra\repositories\interface\ReservationRepositoryInterface;
use charlymatloc\infra\repositories\PDOReservationRepository;
use Psr\Container\ContainerInterface;

//use toubilib\infra\repositories\   ;

return [

    // settings
    'displayErrorDetails' => true,
    'logs.dir' => __DIR__ . '/../var/logs',
    'toubilib.db.config' => __DIR__ . '/.env',


    // PDO CharlyMatloc
    'charlymatloc.pdo' => function (ContainerInterface $c) {
        $config = parse_ini_file($c->get('toubilib.db.config'));
        $dsn = "{$config['charly.driver']}:host={$config['charly.host']};dbname={$config['charly.database']}";
        $user = $config['charly.username'];
        $password = $config['charly.password'];
        return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    },

    // REPOSITORY
    OutilRepositoryInterface::class => function (ContainerInterface $c) {
        return new PDOOutilRepository($c->get("charlymatloc.pdo"));
    },

    PanierRepositoryInterface::class => function (ContainerInterface $c) {
        return new PDOPanierRepository($c->get("charlymatloc.pdo"));
    },

    CategorieRepositoryInterface::class => function (ContainerInterface $c) {
        return new PDOCategorieRepository($c->get("charlymatloc.pdo"));
    },

    ReservationRepositoryInterface::class => function (ContainerInterface $c) {
        return new PDOReservationRepository($c->get("charlymatloc.pdo"));
    },
];

