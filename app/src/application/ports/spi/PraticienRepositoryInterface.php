<?php

namespace toubilib\application\ports\spi;

interface PatientRepositoryInterface
{
    public function findById(string $id): ?\toubilib\domain\entities\Patient;
}