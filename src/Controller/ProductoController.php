<?php

namespace App\Controller;

use App\Dto\ProductoDto;
use App\Entity\Producto;
use App\Repository\ProductoRepository;
use App\Service\ProductoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/producto')]
final class ProductoController extends AbstractController
{
    public function __construct(
        private ProductoService $productoService)
    {}

    #[Route('/all', name:'app_producto_all', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $lista_productos = $this->productoService->findAllProductos();

        // Método para convertir a dto
        $lista_dtos = array_map(fn($producto)=> ProductoDto::createProductoDto($producto), $lista_productos);

        return $this->json($lista_dtos);
    }

    #[Route('/{id}', name: 'app_producto_id', methods: ['GET'])]
    public function getProductoById(Producto $producto): JsonResponse
    {
        $productoDto = ProductoDto::createProductoDto($producto);
        return $this->json($productoDto);
    }


}
