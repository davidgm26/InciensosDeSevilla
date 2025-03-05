<?php

namespace App\Service;


use App\Dto\CrearLineaPedidoDto;
use App\Entity\Pedido;
use App\Entity\Usuario;
use App\Repository\PedidoRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;

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

    public function getPedidosByCliente($idCliente): array
    {
        $cliente = $this->clienteService->getClienteByIdUsuario($idCliente);
        return $this->pedidoRepository->findBy(['cliente' => $cliente->getId()]);
    }

    public function generarNombreDelPedido():string
    {
        $ultimoID = $this->pedidoRepository->findUltimoPedidoPorId();

        $nuevoNumero = $ultimoID + 1;

        return sprintf("PED-%06d", $nuevoNumero);


    }

    public function createPedido(array $data, Usuario $usuario): Pedido
    {
        $pedido = new Pedido();
        $cliente = $this->clienteService->getClienteByIdUsuario($usuario->getId());
        $estado = $this->estadoService->getEstadoById(1);
        $pedido->setCliente($cliente);
        $pedido->setFecha(new DateTime($data['fecha']));
        $pedido->setTotal($data['total']);
        $pedido->setEstado($estado[0]);
        $pedido->setDireccionEntrega($data['direccionDeEntrega']);
        $pedido->setNombre($this->generarNombreDelPedido());
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
        return $pedido;
    }

}