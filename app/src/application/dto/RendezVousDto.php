<?php

namespace toubilib\application\dto;

use toubilib\domain\entities\RendezVous;

class RendezVousDTO
{
    public function __construct(
        public string $id,
        public string $praticienId,
        public string $patientId,
        public string $dateHeureDebut,
        public int $status,
        public int $duree,
        public ?string $dateHeureFin,
        public ?string $dateCreation,
        public ?string $motifVisite
    ) {
    }

    public static function fromEntity(RendezVous $rendezVous): self
    {
        return new self(
            id: $rendezVous->getId(),
            praticienId: $rendezVous->getPraticienId(),
            patientId: $rendezVous->getPatientId(),
            dateHeureDebut: $rendezVous->getDateHeureDebut()->format('Y-m-d H:i:s'),
            status: $rendezVous->getStatus(),
            duree: $rendezVous->getDuree(),
            dateHeureFin: $rendezVous->getDateHeureFin()?->format('Y-m-d H:i:s'),
            dateCreation: $rendezVous->getDateCreation()?->format('Y-m-d H:i:s'),
            motifVisite: $rendezVous->getMotifVisite()
        );
    }
}