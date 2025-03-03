<?php

namespace App\Dto;

class CrearPedidoDto
{
    private $lineasPedidoDto;
    private $fecha;
    private $total;
    private $direccionDeEntrega;

    public function getLineasPedidoDto()
    {
        return $this->lineasPedidoDto;
    }


    public function setLineasPedidoDto($lineasPedidoDto): void
    {
        $this->lineasPedidoDto = $lineasPedidoDto;
    }


    public function getFecha()
    {
        return $this->fecha;
    }


    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }


    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function getDireccionDeEntrega(): string{
        return $this->direccionDeEntrega;
    }

    public function setDireccionDeEntrega(string $direccionDeEntrega): void{
        $this->direccionDeEntrega = $direccionDeEntrega;
    }



}