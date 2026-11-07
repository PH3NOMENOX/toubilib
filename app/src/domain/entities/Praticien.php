<?php

namespace toubilib\domain\entities;

class Praticien
{
    public function __construct(
        private string $id,
        private string $nom,
        private string $prenom,
        private string $ville,
        private string $email,
        private string $telephone,
        private int $specialiteId,
        private ?string $structureId,
        private ?string $rppsId,
        private bool $organisation,
        private bool $nouveauPatient,
        private string $titre
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function getSpecialiteId(): int
    {
        return $this->specialiteId;
    }

    public function getStructureId(): ?string
    {
        return $this->structureId;
    }

    public function getRppsId(): ?string
    {
        return $this->rppsId;
    }

    public function isOrganisation(): bool
    {
        return $this->organisation;
    }

    public function isNouveauPatient(): bool
    {
        return $this->nouveauPatient;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }
}
