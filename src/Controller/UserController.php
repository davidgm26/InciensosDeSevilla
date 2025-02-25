<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Service\UsuarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


#[Route('/api/user')]
final class UserController extends AbstractController
{

    public function __construct(
        private UsuarioService $usuarioService, private readonly Security $security
    ){}


    #[Route('/profile/details', name: 'get_cliente_details', methods: ['GET'])]
    public function getUserDetails()
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        return $this->json($this->usuarioService->getAllProfileDetails($usuario),Response::HTTP_OK);
    }
}