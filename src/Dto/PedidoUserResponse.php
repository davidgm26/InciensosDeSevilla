<?php

namespace App\Dto;



use App\Entity\Pedido;

class PedidoUserResponse
{
    private  $nombre;
    private  $estado;
    private  $fecha;
    private  $total;
    private  $direccion;
    private  $lineasPedido;


    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getLineasPedido()
    {
        return $this->lineasPedido;
    }

    /**
     * @param mixed $lineasPedido
     */
    public function setLineasPedido($lineasPedido): void
    {
        $this->lineasPedido = $lineasPedido;
    }

    public static function createDtoFromPedido(Pedido $pedido)
    {
        $dto = new self();
        $dto->nombre = $pedido->getNombre();
        $dto->estado = $pedido->getEstado()->getNombre();
        $dto->fecha = $pedido->getFecha();
        $dto->total = $pedido->getTotal();
        $lineas = [];
        foreach ($pedido->getLineas() as $linea) {
            $lineas[] = LineaPedidoDto::fromLineaPedido($linea);
        }
        $dto->lineasPedido = $lineas;
        $dto->direccion = $pedido->getDireccionEntrega();
        return $dto;

    }

}
