<?php

namespace App\Dto;

use App\Entity\Producto;

class ProductoDto
{
    private $precio;

    private $nombre;

    private $descripcion;

    private $imagen;

    private $totalResenias;





    public static function createProductoDto(Producto $producto) : ProductoDto{

        $dto = new self();
        $dto->precio = $producto->getPrecio();
        $dto->nombre = $producto->getNombre();
        $dto->descripcion = $producto->getDescripcion();
        $dto ->totalResenias = $producto->get

        return $dto;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function getTotalResenias(): ?int
    {
        return $this->totalResenias;
    }

}