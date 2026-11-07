<?php

namespace toubilib\domain\entities;

use DateTime;

class RendezVous
{
    public const STATUS_CONFIRME = 0;
    public const STATUS_ANNULE = 1;

    private string $id;
    private string $praticienId;
    private string $patientId;
    private DateTime $dateHeureDebut;
    private int $status;
    private int $duree;
    private ?DateTime $dateHeureFin;
    private ?DateTime $dateCreation;
    private ?string $motifVisite;

    public function __construct(
        string $id,
        string $praticienId,
        string $patientId,
        DateTime $dateHeureDebut,
        int $status = self::STATUS_CONFIRME,
        int $duree = 30,
        ?DateTime $dateHeureFin = null,
        ?DateTime $dateCreation = null,
        ?string $motifVisite = null
    ) {
        $this->id = $id;
        $this->praticienId = $praticienId;
        $this->patientId = $patientId;
        $this->dateHeureDebut = $dateHeureDebut;
        $this->status = $status;
        $this->duree = $duree;
        $this->dateHeureFin = $dateHeureFin;
        $this->dateCreation = $dateCreation;
        $this->motifVisite = $motifVisite;
    }

    public function annuler(): void
    {
        if ($this->dateHeureDebut <= new DateTime()) {
            throw new \DomainException(
                "Un rendez-vous passé ne peut pas être annulé."
            );
        }

        if ($this->status !== self::STATUS_CONFIRME) {
            throw new \DomainException(
                "Ce rendez-vous ne peut pas être annulé."
            );
        }

        $this->status = self::STATUS_ANNULE;
    }

    public function estConfirme(): bool
    {
        return $this->status === self::STATUS_CONFIRME;
    }

    public function estAnnule(): bool
    {
        return $this->status === self::STATUS_ANNULE;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPraticienId(): string
    {
        return $this->praticienId;
    }

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function getDateHeureDebut(): DateTime
    {
        return $this->dateHeureDebut;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getDateHeureFin(): ?DateTime
    {
        return $this->dateHeureFin;
    }

    public function getDateCreation(): ?DateTime
    {
        return $this->dateCreation;
    }

    public function getMotifVisite(): ?string
    {
        return $this->motifVisite;
    }
}