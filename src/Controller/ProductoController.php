<?php

namespace App\Controller;

use App\Dto\ProductoDto;
use App\Dto\ReseniaDto;
use App\Entity\Categoria;
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Repository\ProductoRepository;
use App\Service\ProductoService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/producto')]
final class ProductoController extends AbstractController
{
    public function __construct(
        private ProductoService $productoService,
        private Security $security,

    )
    {
    }

    #[Route('/all', name: 'get_all_productos', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $lista_productos = $this->productoService->findAllProductos();
        $lista_dtos = array_map(fn($producto) => ProductoDto::createProductoDto($producto), $lista_productos);

        return $this->json($lista_dtos);
    }


    #[Route('/all/activos/categoria/{id}', name: 'get_all_productos_activos_categoria', methods: ['GET'])]
    public function getAllActivos(Categoria $categoria): JsonResponse
    {
        $lista_productos = $this->productoService->findAllProductosActivosByCategory($categoria);

        foreach ($lista_productos as $producto) {
            $producto->setValoracion();
        }

        $lista_dtos = array_map(fn($producto) => ProductoDto::createProductoDto($producto), $lista_productos);

        return $this->json($lista_dtos);
    }

    #[Route('/categoria/{id}', name: 'get_producto_categoria', methods: ['GET'])]
    public function getAllProductosByCategoria(Categoria $categoria): JsonResponse
    {
        $lista_productos = $this->productoService->findAllProductosByCategory($categoria);
        $lista_productos_dto = array_map(fn($producto) => ProductoDto::createProductoDto($producto), $lista_productos);
        return $this->json($lista_productos_dto);
    }

    #[Route('/limitados', name: 'get_productos_limitados', methods: ['GET'])]
    public function getLimitedProductos(): JsonResponse
    {
        $lista_productos = $this->productoService->findProductosLimitados();
        $lista_productos_dto = array_map(fn($producto) => ProductoDto::createProductoDto($producto), $lista_productos);
        return $this->json($lista_productos_dto);

    }

    #[Route('/{id}', name: 'get_producto_byid', methods: ['GET'])]
    public function getProductoById(Producto $producto): JsonResponse
    {
        $producto->setValoracion();
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

    #[Route('/editar/{id}', name: 'editar_producto', methods: ['PUT'])]
    public function editProducto(Request $request, Producto $producto): JsonResponse
    {
        $json = json_decode($request->getContent(), true);
        $productoMod = $this->productoService->editProducto($producto, $json);
        $productoDto = ProductoDto::createProductoDto($productoMod);
        return $this->json($productoDto);
    }


    #[Route('/{id}', name: 'borrar_producto', methods: ['DELETE'])]
    public function deleteProducto(Producto $producto): JsonResponse
    {
        $this->productoService->deleteProducto($producto);
        return $this->json("Producto borrado con éxito", 204);
    }

    #[Route('/status/{id}', name: 'cambiar_estado_producto', methods: ['PUT'])]
    public function cambiarVisibilidad(Producto $producto): JsonResponse
    {
        $prodCambiado = ProductoDto::createProductoDto($this->productoService->modificarEstado($producto));
        return $this->json($prodCambiado);
    }

    #[Route('/resenias/{id}', name: 'ver_resenias_producto', methods: ['GET'])]
    public function obtenerResenias(Producto $producto): JsonResponse
    {
        return $this->json($this->productoService->obtenerResenias($producto));
    }

    #[Route('/resenia/new/{id}', name: 'crear_resenia', methods: ['POST'])]
    public function crearResenia(Request $reseniaDto, Producto $producto): JsonResponse
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        $request = json_decode($reseniaDto->getContent(), true);
        return $this->json($this->productoService->crearReseniaDto($this->productoService->crearResenia($request, $producto, $usuario)));
    }


}
