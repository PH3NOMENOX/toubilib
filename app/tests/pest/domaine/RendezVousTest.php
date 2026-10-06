<?php

use toubilib\domain\entities\RendezVous;

it('peut annuler un rendez-vous futur confirmé', function () {

    $rdv = new RendezVous(
        'rdv-1',
        'praticien-1',
        'patient-1',
        new DateTime('+1 day'),
        RendezVous::STATUS_CONFIRME
    );

    $rdv->annuler();

    expect($rdv->getStatus())
        ->toBe(RendezVous::STATUS_ANNULE);
});


it('ne peut pas annuler un rendez-vous passé', function () {

    $rdv = new RendezVous(
        'rdv-2',
        'praticien-1',
        'patient-1',
        new DateTime('-1 day'),
        RendezVous::STATUS_CONFIRME
    );

    expect(fn () => $rdv->annuler())
        ->toThrow(DomainException::class);
});


it('ne peut pas annuler un rendez-vous déjà annulé', function () {

    $rdv = new RendezVous(
        'rdv-3',
        'praticien-1',
        'patient-1',
        new DateTime('+1 day'),
        RendezVous::STATUS_ANNULE
    );

    expect(fn () => $rdv->annuler())
        ->toThrow(DomainException::class);
});