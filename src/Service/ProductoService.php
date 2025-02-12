<?php

namespace App\Service;

use App\Dto\ReseniaDto;
use App\Entity\Categoria;
use App\Entity\Producto;
use App\Entity\Resenia;
use App\Repository\ProductoRepository;
use App\Service\ClienteService;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Sodium\add;

class ProductoService
{

    public function __construct(
        private ProductoRepository          $productoRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private CategoriaService            $categoriaService,
        private EntityManagerInterface      $entityManager, private readonly ClienteService $clienteService
    )
    {
    }

    public function findProductoById(int $idProducto): Producto
    {
        return $this->productoRepository->find($idProducto);
    }


    public function findAllProductos(): array
    {
        return $this->productoRepository->findAll();
    }

    public function findAllProductosActivosByCategory($categoria): array
    {

        return $this->productoRepository->findAllActivosByCategory($categoria);
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
        $productoABorrar->getResenias()->removeElement($productoABorrar->getResenias());
        $this->entityManager->remove($productoABorrar);
        $this->entityManager->flush();
    }

    public function editProducto($producto, array $request): Producto
    {
        $productoACambiar = $this->findProductoById($producto->getId());
        $categoriaAntigua = $producto->getCategoria();
        $categoriaAntigua->removeProducto($productoACambiar);
        $productoACambiar->setNombre($request['nombre']);
        $productoACambiar->setDescripcion($request['descripcion']);
        $categoriaId = $request['categoria']['id'];
        $categoria = $this->categoriaService->findCategoriaById($categoriaId);
        $productoACambiar->setCategoria($categoria);
        $categoria->addProducto($productoACambiar);
        $productoACambiar->setPrecio($request['precio']);
        $this->entityManager->flush();
        return $productoACambiar;
    }

    public function modificarEstado($producto)
    {
        $prodBuscado = $this->productoRepository->find($producto->getId());
        $prodBuscado->setActivo(!$prodBuscado->getActivo());
        $this->entityManager->persist($prodBuscado);
        $this->entityManager->flush();
        return $prodBuscado;
    }
    public function obtenerResenias($producto)
    {
        $prodBuscado = $this->productoRepository->find($producto->getId());
        $listaResenias = $prodBuscado->getResenias();
        $listaReseniasDto = [];

        foreach ($listaResenias as $resenia) {
            $listaReseniasDto[] = $this->crearReseniaDto($resenia);
        }

        return $listaReseniasDto;
    }

    public function crearReseniaDto(Resenia $resenia): ReseniaDto
    {
        $cliente = $resenia->getCliente();
        $nombre = $cliente->getNombre() . ' ' . $cliente->getApellido();

        $dto = new ReseniaDto();
        $dto->setCliente($nombre);
        $dto->setTexto($resenia->getTexto());
        $dto->setValoracion($resenia->getValoracion());

        return $dto;
    }



}