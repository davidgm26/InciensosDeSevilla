<?php

namespace App\Dto;

use App\Entity\Producto;

class ProductoDto
{
    private $id;

    private $precio;

    private $nombre;

    private $descripcion;

    private $categoria;

    private $imagen;

    private $totalResenias;

    private $activo;

    public static function createProductoDto(Producto $producto) : ProductoDto{

        $dto = new self();
        $dto->id = $producto->getId();
        $dto->precio = $producto->getPrecio();
        $dto->nombre = $producto->getNombre();
        $dto->descripcion = $producto->getDescripcion();
        $dto ->totalResenias = sizeof($producto->getResenias());
        $dto->categoria = $producto->getCategoria()->getNombre();
        $dto->imagen= $producto->getUrlFoto();
        $dto->activo= $producto->getActivo();
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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getActivo()
    {
        return $this->activo;
    }




}