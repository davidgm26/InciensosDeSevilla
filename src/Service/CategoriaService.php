<?php

namespace App\Service;

use App\Repository\CategoriaRepository;

class CategoriaService
{
    public function __construct(
        private CategoriaRepository $categoriaRepository,
    ) {}

    public function findAllCategorias()
    {
        return $this->categoriaRepository->findAll();
    }

    public function findCategoriaById(int $id)
    {
        return $this->categoriaRepository->findCategoriaById($id);
    }
}