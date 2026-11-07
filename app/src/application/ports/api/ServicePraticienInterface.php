<?php

namespace toubilib\application\ports\api;

use toubilib\application\dto\PraticienDTO;

interface ServicePraticienInterface
{
    /**
     * @return PraticienDTO[]
     */
    public function lister(): array;
}
