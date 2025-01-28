<?php

namespace App\Service;

use App\Entity\Producto;
use App\Repository\ProductoRepository;

class ProductoService
{

    public function __construct(
        private ProductoRepository $productoRepository
    ){}

    public function findProductoById(int $idProducto, ProductoRepository $productoRepository): Producto
    {
        return $this->productoRepository->find($idProducto);
    }


    public function findAllProductos(): array
    {
        return $this->productoRepository->findAll();
    }

    public function findAllProductosByCategory(string $category): array
    {
        return $this->productoRepository->findBy(['categoria' => $category]);
    }

}