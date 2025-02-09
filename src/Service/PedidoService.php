<?php

namespace App\Service;


use App\Dto\CrearLineaPedidoDto;
use App\Entity\Pedido;
use App\Repository\PedidoRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class PedidoService
{
    public function __construct(
        private PedidoRepository $pedidoRepository,
        private LinPedidoService $linPedidoService,
        private ClienteService $clienteService,
        private EstadoService $estadoService,
        private EntityManagerInterface $entityManager


    )
    {}

    public function getPedidos(): array
    {
        return $this->pedidoRepository->findAll();
    }

    public function getPedido(int $id): Pedido
    {
        return $this->pedidoRepository->find($id);
    }

    public function getPedidosByCliente(int $idCliente): array
    {
        return $this->pedidoRepository->findBy(['cliente' => $idCliente]);
    }

    public function createPedido(array $data): Pedido
    {
        $pedido = new Pedido();
        $cliente = $this->clienteService->getClienteById($data['idCliente']);
        $estado = $this->estadoService->getEstadoById(1);
        $pedido->setCliente($cliente);
        $pedido->setFecha(new DateTime($data['fecha']));
        $pedido->setTotal($data['total']);
        $pedido->setEstado($estado[0]);
        $this->entityManager->persist($pedido);
        foreach ($data['lineasPedidosDto'] as $line) {
            $lineaPedido = new CrearLineaPedidoDto();
            $lineaPedido->setPrecioUnitario($line['precioUnitario']);
            $lineaPedido->setCantidad($line['cantidad']);
            $lineaPedido->setSubtotal($line['subtotal']);
            $lineaPedido->setIdProducto($line['idProducto']);
            $pedido->addLinea( $this->linPedidoService->createLinPedido($lineaPedido,$pedido));
        }
        $this->entityManager->flush();

        $this->entityManager->persist($pedido);
        $this->entityManager->flush();
        return $pedido;
    }

}