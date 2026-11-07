<?php

namespace toubilib\adapters;

use PDO;
use toubilib\domain\entities\Patient;
use toubilib\application\ports\spi\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function __construct(private PDO $pdo) {}

    public function findById(string $id): ?Patient
    {
        $sql = "SELECT * FROM patient WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Patient(
            id: $data['id'],
            nom: $data['nom'],
            prenom: $data['prenom'],
            dateNaissance: $data['date_naissance'],
            adresse: $data['adresse'],
            codePostal: $data['code_postal'],
            ville: $data['ville'],
            email: $data['email'],
            telephone: $data['telephone']
        );
    }
}
