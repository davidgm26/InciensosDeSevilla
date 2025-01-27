<?php

namespace App\Controller;

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

    #[Route('/all', name: 'app_categoria_all', methods: ['GET'])]
    public function getAll(): JsonResponse
    {
        $listaCatorias =  $this->categoriaService->findAllCategorias();
        return $this->json($listaCatorias);
    }

    #[Route('/{id}', name: 'app_categoria_show', methods: ['GET'])]
    public function getProductById(int $id): JsonResponse{

    }


}
