<?php

namespace toubilib\application\dto;

use toubilib\domain\entities\Praticien;

class PraticienDTO
{
    public function __construct(
        public string $id,
        public string $nom,
        public string $prenom,
        public string $ville,
        public string $email,
        public string $telephone,
        public int $specialiteId,
        public ?string $structureId,
        public ?string $rppsId,
        public bool $organisation,
        public bool $nouveauPatient,
        public string $titre
    ) {}

    public static function fromEntity(Praticien $praticien): self
    {
        return new self(
            id: $praticien->getId(),
            nom: $praticien->getNom(),
            prenom: $praticien->getPrenom(),
            ville: $praticien->getVille(),
            email: $praticien->getEmail(),
            telephone: $praticien->getTelephone(),
            specialiteId: $praticien->getSpecialiteId(),
            structureId: $praticien->getStructureId(),
            rppsId: $praticien->getRppsId(),
            organisation: $praticien->isOrganisation(),
            nouveauPatient: $praticien->isNouveauPatient(),
            titre: $praticien->getTitre()
        );
    }
}
