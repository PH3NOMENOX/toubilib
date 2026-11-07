<?php

namespace toubilib\application\usecases;

use toubilib\application\dto\RendezVousDto;
use toubilib\application\dto\CreateRdvDTO;
use toubilib\application\validators\RendezVousValidator;
use toubilib\application\ports\api\ServiceRendezVousInterface;
use toubilib\application\ports\spi\RendezVousRepositoryInterface;
use RuntimeException;

class ServiceRendezVous implements ServiceRendezVousInterface
{
    public function __construct(
        private RendezVousRepositoryInterface $repository,
        private RendezVousValidator $validator
    ) {}

    public function annuler(string $id): RendezVousDto
    {
        $rendezVous = $this->repository->findById($id);

        if ($rendezVous === null) {
            throw new RuntimeException("Rendez-vous introuvable.", 404);
        }

        $rendezVous->annuler();
        $this->repository->save($rendezVous);

        return RendezVousDto::fromEntity($rendezVous);
    }

    public function creer(CreateRdvDTO $dto): CreateRdvDTO
    {
        $this->validator->verifierExistence(
            $dto->patientId,
            $dto->praticienId
        );

        return $dto;
    }
}
