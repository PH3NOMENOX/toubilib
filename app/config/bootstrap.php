<?php

declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;
use toubilib\adapters\RendezVousRepository;
use toubilib\application\ports\api\ServiceRendezVousInterface;
use toubilib\application\ports\spi\RendezVousRepositoryInterface;
use toubilib\application\usecases\ServiceRendezVous;
use toubilib\adapters\actions\AnnulerRendezVousAction;

$container = new Container();

$container->set(PDO::class, function () {

    return new PDO(
        'pgsql:host=toubilib.db;port=5432;dbname=toubilib',
        'toubilib',
        'toubilib',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
});


$container->set(
    RendezVousRepositoryInterface::class,
    function (Container $container) {
        return new RendezVousRepository(
            $container->get(PDO::class)
        );
    }
);


$container->set(
    ServiceRendezVousInterface::class,
    function (Container $container) {
        return new ServiceRendezVous(
            $container->get(RendezVousRepositoryInterface::class)
        );
    }
);

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->delete(
    '/rdv/{id}/annuler',
    AnnulerRendezVousAction::class
);

return $app;