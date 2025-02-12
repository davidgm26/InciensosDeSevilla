<?php

namespace App\Dto;

class CrearLineaPedidoDto
{

    private $idProducto;

    private $cantidad;

    private $precioUnitario;

    private $subtotal;


    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal): void
    {
        $this->subtotal = $subtotal;
    }


    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario($precio): void
    {
        $this->precioUnitario = $precio;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad): void
    {
        $this->cantidad = $cantidad;
    }


    public function getIdProducto()
    {
        return $this->idProducto;
    }


    public function setIdProducto($idProducto): void
    {
        $this->idProducto = $idProducto;
    }




}