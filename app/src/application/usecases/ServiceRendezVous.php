<?php

namespace toubilib\application\usecases;

use toubilib\application\dto\RendezVousDTO;
use toubilib\application\ports\api\ServiceRendezVousInterface;
use toubilib\application\ports\spi\RendezVousRepositoryInterface;

class ServiceRendezVous implements ServiceRendezVousInterface
{
    public function __construct(
        private RendezVousRepositoryInterface $repository
    ) {
    }

    public function annuler(string $id): RendezVousDTO
    {
        
        $rendezVous = $this->repository->findById($id);

       
        if ($rendezVous === null) {
            throw new \RuntimeException(
                "Rendez-vous introuvable."
            );
        }

      
        $rendezVous->annuler();

        $this->repository->save($rendezVous);

        return RendezVousDTO::fromEntity($rendezVous);
    }
}