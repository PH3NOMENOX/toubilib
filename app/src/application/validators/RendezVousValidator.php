<?php

namespace toubilib\application\validators;

use toubilib\application\ports\spi\PatientRepositoryInterface;
use toubilib\application\ports\spi\PraticienRepositoryInterface;

class RendezVousValidator
{
    public function __construct(
        private PatientRepositoryInterface $patientRepository,
        private PraticienRepositoryInterface $praticienRepository
    ) {}

    public function verifierExistence(
        string $patientId,
        string $praticienId
    ): void {
        if ($this->patientRepository->findById($patientId) === null) {
            throw new \InvalidArgumentException(
                "Le patient n'existe pas."
            );
        }

        if ($this->praticienRepository->findById($praticienId) === null) {
            throw new \InvalidArgumentException(
                "Le praticien n'existe pas."
            );
        }
    }
}
