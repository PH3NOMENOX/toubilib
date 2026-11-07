<?php

use function DI\create;
use function DI\get;
use toubilib\adapters\actions\ListerPraticiensAction;
use toubilib\adapters\actions\AnnulerRendezVousAction;
use toubilib\application\ports\api\ServiceRendezVousInterface;
use toubilib\application\ports\api\ServicePraticienInterface;
return [

    AnnulerRendezVousAction::class => create()
        ->constructor(
            get(ServiceRendezVousInterface::class)
        ),
    ListerPraticiensAction::class => create()
        ->constructor(
            get(ServicePraticienInterface::class)
        ),
];
