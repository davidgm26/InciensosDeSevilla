<?php

namespace App\Controller;

use App\Dto\CategoriaResponse;
use App\Repository\CategoriaRepository;
use App\Service\CategoriaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/api/categoria')]
final class CategoriaController extends AbstractController
{
    public function __construct(
        private CategoriaService $categoriaService
    ){}

    #[Route('/all', name: 'get_all_categoria', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $listaCategorias =  $this->categoriaService->findAllCategorias();
        $listaCategoriasDto = array_map(fn($cat) => CategoriaResponse::createCategoriaResponse($cat), $listaCategorias);

        return $this->json($listaCategoriasDto);
    }

    #[Route('/{id}', name: 'app_categoria_show', methods: ['GET'])]
    public function getProductById(int $id): JsonResponse
    {

    }


}
