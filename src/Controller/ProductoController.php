<?php

namespace App\Controller;

use App\Dto\ProductoDto;
use App\Entity\Categoria;
use App\Entity\Producto;
use App\Repository\ProductoRepository;
use App\Service\ProductoService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/producto')]
final class ProductoController extends AbstractController
{
    public function __construct(
        private ProductoService $productoService,
    )
    {}

    #[Route('/all', name:'get_all_productos', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $lista_productos = $this->productoService->findAllProductos();

        // Método para convertir a dto
        $lista_dtos = array_map(fn($producto)=> ProductoDto::createProductoDto($producto), $lista_productos);

        return $this->json($lista_dtos);
    }

    #[Route('/limitados', name: 'get_productos_limitados', methods: ['GET'])]
    public function getLimitedProductos(): JsonResponse
    {
        $lista_productos = $this->productoService->findProductosLimitados();
        $lista_productos_dto=array_map(fn($producto)=> ProductoDto::createProductoDto($producto), $lista_productos);
        return $this->json($lista_productos_dto);

    }

    #[Route('/{id}', name: 'get_producto_byid', methods: ['GET'])]
    public function getProductoById(Producto $producto): JsonResponse
    {
        $productoDto = ProductoDto::createProductoDto($producto);
        return $this->json($productoDto);
    }

    #[Route('/new', name: 'create_producto', methods: ['POST'])]
    public function createProducto(Request $request, EntityManager $entityManager): JsonResponse
    {


        $producto = new Producto();
        $json = json_decode($request->getContent(), true);
        $producto->setNombre($json['nombre']);
        $producto->setDescripcion($json['descripcion']);
        $producto->setPrecio($json['precio']);

        $entityManager->persist($producto);
        $entityManager->flush();

        return $this->json($producto);
    }

    #[Route('/{id}', name: 'editar_producto', methods: ['PUT'])]
    public function editProducto(Request $request, Producto $producto , EntityManager $entityManager): JsonResponse
    {
        $json = json_decode($request->getContent(), true);
        $producto->setNombre($json['nombre']);
        $producto->setDescripcion($json['descripcion']);
        $producto->setPrecio($json['precio']);

        $entityManager->flush();
        return $this->json($producto);
    }

    #[Route('/categoria/{id}', name: 'get_producto_categoria', methods: ['GET'])]
    public function getAllProductosByCategoria(Categoria $categoria):JsonResponse
    {
       $lista_productos =$this->productoService->findAllProductosByCategory($categoria);
       $lista_productos_dto=array_map(fn($producto)=> ProductoDto::createProductoDto($producto), $lista_productos);

       return $this->json($lista_productos_dto);
    }



        
}
