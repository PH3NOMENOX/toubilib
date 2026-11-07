<?php

namespace toubilib\adapters;

use PDO;
use toubilib\domain\entities\Praticien;
use toubilib\application\ports\spi\PraticienRepositoryInterface;

class PraticienRepository implements PraticienRepositoryInterface
{
    public function __construct(
        private PDO $pdo
    ) {}

    public function findAll(): array
    {
        $sql = "
            SELECT *
            FROM praticien
            ORDER BY nom, prenom
        ";

        $stmt = $this->pdo->query($sql);

        $praticiens = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $praticiens[] = $this->hydrate($data);
        }

        return $praticiens;
    }

    public function findById(string $id): ?Praticien
    {
        $sql = "
            SELECT *
            FROM praticien
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data === false) {
            return null;
        }

        return $this->hydrate($data);
    }

    private function hydrate(array $data): Praticien
    {
        return new Praticien(
            id: $data['id'],
            nom: $data['nom'],
            prenom: $data['prenom'],
            ville: $data['ville'],
            email: $data['email'],
            telephone: $data['telephone'],
            specialiteId: (int) $data['specialite_id'],
            structureId: $data['structure_id'],
            rppsId: $data['rpps_id'],
            organisation: (bool) ((int) $data['organisation']),
            nouveauPatient: (bool) ((int) $data['nouveau_patient']),
            titre: $data['titre']
        );
    }
}