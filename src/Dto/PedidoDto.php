<?php

namespace App\Dto;

use App\Entity\Pedido;

class PedidoDto
{

    private $id;

    private $lineasPedidos;

    private $fecha;

    private $total;

    private $estado;

    private $cliente;


    public static function fromPedido(Pedido $pedido){
        $dto = new self();
        $lineas = [];
        foreach ($pedido->getLineas() as $linea) {
            $lineas[] = LineaPedidoDto::fromLineaPedido($linea);
        }
        $dto->id = $pedido->getId();
        $dto->fecha = $pedido->getFecha();
        $dto->total = $pedido->getTotal();
        $dto->estado = $pedido->getEstado();
        $dto->cliente  = ClienteResponse::createClienteResponse($pedido->getCliente());
        $dto->lineasPedidos = $lineas;
        return $dto;

    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }



    public function getId()
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getLineasPedidos()
    {
        return $this->lineasPedidos;
    }


    public function setLineasPedidos($lineasPedidos): void
    {
        $this->lineasPedidos = $lineasPedidos;
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

    public function getEstado()
    {
        return $this->estado;
    }


    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }



}