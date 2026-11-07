<?php

namespace toubilib\application\usecases;

use toubilib\application\dto\PraticienDTO;
use toubilib\application\ports\api\ServicePraticienInterface;
use toubilib\application\ports\spi\PraticienRepositoryInterface;

class ServicePraticien implements ServicePraticienInterface
{
    public function __construct(
        private PraticienRepositoryInterface $repository
    ) {}

    public function lister(): array
    {
        $praticiens = $this->repository->findAll();

        return array_map(
            fn ($praticien) => PraticienDTO::fromEntity($praticien),
            $praticiens
        );
    }
}
