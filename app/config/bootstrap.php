<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use toubilib\adapters\actions\AnnulerRendezVousAction;
use toubilib\adapters\actions\ListerPraticiensAction;
$builder = new ContainerBuilder();

$builder->useAutowiring(false);

$builder->addDefinitions(__DIR__ . '/settings.php');
$builder->addDefinitions(__DIR__ . '/services.php');
$builder->addDefinitions(__DIR__ . '/api.php');

$container = $builder->build();

$app = AppFactory::createFromContainer($container);

$app->addBodyParsingMiddleware();

$app->delete(
    '/rdv/{id}/annuler',
    AnnulerRendezVousAction::class
);
$app->get(
    '/praticiens',
    function ($request, $response, $args) use ($container) {
        $action = $container->get(ListerPraticiensAction::class);
        return $action($request, $response, $args);
    }
);

return $app;
