<?php

namespace App\Dto;

use App\Entity\LineaPedido;
use App\Entity\Producto;

class LineaPedidoDto
{
    private $producto;

    private $cantidad;

    private $precio;

    private $total;



    public static function fromLineaPedido(LineaPedido $lineaPedido){
        $dto = new self();
        $dto->producto = ProductoDto::createProductoDto($lineaPedido->getProducto());
        $dto->cantidad = $lineaPedido->getCantidad();
        $dto->precio = $lineaPedido->getPrecioUnitario();
        $dto->total = $lineaPedido->getPrecioLinea();
        return $dto;
    }

    public function getProducto()
    {
        return $this->producto;
    }


    public function setProducto($producto): void
    {
        $this->producto = $producto;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }


    public function setCantidad($cantidad): void
    {
        $this->cantidad = $cantidad;
    }


    public function getPrecio()
    {
        return $this->precio;
    }


    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }


    public function getTotal()
    {
        return $this->total;
    }


    public function setTotal($total): void
    {
        $this->total = $total;
    }


}
