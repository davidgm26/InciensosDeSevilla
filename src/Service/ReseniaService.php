<?php

namespace App\Service;


use App\Dto\CrearLineaPedidoDto;
use App\Entity\Cliente;
use App\Entity\Pedido;
use App\Entity\Resenia;
use App\Entity\Usuario;
use App\Repository\PedidoRepository;
use App\Repository\ReseniaRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;

class ReseniaService
{
    public function __construct(
        private PedidoRepository $pedidoRepository,
        private ReseniaRepository $reseniaRepository,
        private EntityManagerInterface $entityManager,
    )
    {}

    public function getAllReseniasByCliente(Cliente $cliente): array
    {
        return $this->reseniaRepository->findBy(['cliente' => $cliente]);
    }

    public function borrarResenia(Resenia $resenia)
    {
        $this->entityManager->remove($resenia);
        $this->entityManager->flush();
    }
}