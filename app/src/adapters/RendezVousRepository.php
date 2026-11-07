<?php

namespace toubilib\adapters;

use PDO;
use DateTime;
use toubilib\domain\entities\RendezVous;
use toubilib\application\ports\spi\RendezVousRepositoryInterface;

class RendezVousRepository implements RendezVousRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public function findById(string $id): ?RendezVous
    {
        $sql = "
            SELECT
                id,
                praticien_id,
                patient_id,
                date_heure_debut,
                status,
                duree,
                date_heure_fin,
                date_creation,
                motif_visite
            FROM rdv
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return null;
        }

        return new RendezVous(
            id: $data['id'],
            praticienId: $data['praticien_id'],
            patientId: $data['patient_id'],
            dateHeureDebut: new DateTime($data['date_heure_debut']),
            status: (int) $data['status'],
            duree: (int) $data['duree'],
            dateHeureFin: $data['date_heure_fin']
                ? new DateTime($data['date_heure_fin'])
                : null,
            dateCreation: $data['date_creation']
                ? new DateTime($data['date_creation'])
                : null,
            motifVisite: $data['motif_visite']
        );
    }

    public function save(RendezVous $rendezVous): void
    {
        $sql = "
            UPDATE rdv
            SET status = :status
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'status' => $rendezVous->getStatus(),
            'id' => $rendezVous->getId()
        ]);
    }
}