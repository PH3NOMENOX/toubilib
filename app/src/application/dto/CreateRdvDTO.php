<?php

namespace toubilib\application\dto;

class CreateRdvDTO
{
    public function __construct(
        public string $patientId,
        public string $praticienId,
        public string $dateHeureDebut,
        public string $motifVisite
    ) {}
}
