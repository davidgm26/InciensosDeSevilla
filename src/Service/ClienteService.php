<?php

namespace App\Service;

use App\Repository\ClienteRepository;

class ClienteService
{

    public function __construct(
        private ClienteRepository $clienteRepository,
    ){}

    public function findAllClientes(): array
    {
        return $this->clienteRepository->findAll();
    }
}