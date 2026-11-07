<?php

use DI\Container;

use toubilib\adapters\RendezVousRepository;
use toubilib\adapters\PraticienRepository;
use toubilib\adapters\PatientRepository;

use toubilib\application\ports\api\ServiceRendezVousInterface;
use toubilib\application\ports\api\ServicePraticienInterface;

use toubilib\application\ports\spi\RendezVousRepositoryInterface;
use toubilib\application\ports\spi\PraticienRepositoryInterface;
use toubilib\application\ports\spi\PatientRepositoryInterface;

use toubilib\application\usecases\ServiceRendezVous;
use toubilib\application\usecases\ServicePraticien;

use toubilib\application\validators\RendezVousValidator;

return [

    PDO::class => function (Container $container) {
        return new PDO(
            'pgsql:host=' . $container->get('db.host')
            . ';port=' . $container->get('db.port')
            . ';dbname=' . $container->get('db.name'),

            $container->get('db.user'),
            $container->get('db.password'),

            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    },

    RendezVousRepositoryInterface::class => function (Container $container) {
        return new RendezVousRepository(
            $container->get(PDO::class)
        );
    },

    PraticienRepositoryInterface::class => function (Container $container) {
        return new PraticienRepository(
            $container->get(PDO::class)
        );
    },

    PatientRepositoryInterface::class => function (Container $container) {
        return new PatientRepository(
            $container->get(PDO::class)
        );
    },

    RendezVousValidator::class => function (Container $container) {
        return new RendezVousValidator(
            $container->get(PatientRepositoryInterface::class),
            $container->get(PraticienRepositoryInterface::class)
        );
    },

    ServicePraticienInterface::class => function (Container $container) {
        return new ServicePraticien(
            $container->get(PraticienRepositoryInterface::class)
        );
    },

    ServiceRendezVousInterface::class => function (Container $container) {
        return new ServiceRendezVous(
            $container->get(RendezVousRepositoryInterface::class),
            $container->get(RendezVousValidator::class)
        );
    },

];
