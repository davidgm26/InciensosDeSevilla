<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Service\UsuarioService;
use Doctrine\ORM\EntityManagerInterface;
use Rol;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends AbstractController
{
    public function __construct(
        private UsuarioService $usuarioService,
    )
    {}

    #[Route('/registro', name: 'registrar_usuario_cliente', methods: ['POST'])]
    public function register(Request $request,
                             UserPasswordHasherInterface $passwordHasher,
                             EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->usuarioService->registrarUsuario($data);




        return new JsonResponse(['message' => 'Usuario registrado con éxito'], 201);
    }

}
