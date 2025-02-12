<?php

namespace App\Service;


use App\Dto\CrearLineaPedidoDto;
use App\Dto\LineaPedidoDto;
use App\Entity\LineaPedido;
use App\Entity\Pedido;
use App\Repository\PedidoRepository;
use Doctrine\ORM\EntityManagerInterface;

class LinPedidoService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProductoService $productoService,
    ){}

    public function createLinPedido(CrearLineaPedidoDto $lineaPedidoDto,Pedido $pedido): LineaPedido
    {
        $lineaPedido = new LineaPedido();
        $lineaPedido->setPedido($pedido);
        $producto= $this->productoService->findProductoById($lineaPedidoDto->getIdProducto());
        $lineaPedido->setProducto($producto);
        $lineaPedido->setCantidad($lineaPedidoDto->getCantidad());
        $lineaPedido->setPrecioUnitario($lineaPedidoDto->getPrecioUnitario());
        $lineaPedido->setPrecioLinea($lineaPedidoDto->getSubtotal());
        $this->entityManager->persist($lineaPedido);
        $this->entityManager->flush();
        return $lineaPedido;
    }
}