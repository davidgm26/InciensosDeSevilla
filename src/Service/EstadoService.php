<?php

namespace App\Service;

use App\Entity\Estado;
use App\Repository\EstadoRepository;
use Doctrine\ORM\EntityManagerInterface;

class EstadoService
{
    public function __construct(
        private EstadoRepository $estadoRepository,
    ){}

    public function getEstadoById($id): array
    {
        return $this->estadoRepository->findById($id);
    }

}