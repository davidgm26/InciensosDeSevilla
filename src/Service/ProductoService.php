<?php

namespace App\Service;

use App\Entity\Categoria;
use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProductoService
{

    public function __construct(
        private ProductoRepository $productoRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager
    ){}

    public function findProductoById(int $idProducto): Producto
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

    public function deleteProducto($producto)
    {
        $productoABorrar = $this->findProductoById($producto->getId());
        $productoABorrar -> getResenias() -> removeElement($productoABorrar->getResenias());
        $this->entityManager->remove($productoABorrar);
        $this->entityManager->flush();
    }

    public function editProducto($producto,$request): Producto
    {
        $productoACambiar = $this->findProductoById($producto->getId());
        $productoACambiar -> setNombre($request -> get('nombre'));
        $productoACambiar -> setDescripcion($request -> get('descripcion'));
        $productoACambiar -> setCategoria($request -> get('categoria'));
        $productoACambiar -> setPrecio($request -> get('precio'));
        $productoACambiar -> setStock($request -> get('stock'));
        $this->entityManager->persist($productoACambiar);
        $this->entityManager->flush();
        return $producto;
    }

}