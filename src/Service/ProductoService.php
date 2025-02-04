<?php

namespace App\Service;

use App\Entity\Categoria;
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

    public function findAllProductosByCategory(Categoria $category): array
    {
        return $this->productoRepository->findBy(['categoria' => $category]);
    }

    public function findProductosLimitados(): array
    {
        return $this->productoRepository->findProductosLimitados();
    }

}