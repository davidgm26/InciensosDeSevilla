<?php

namespace App\Controller;

use App\Service\UsuarioService;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/auth')]
final class AuthController extends AbstractController
{
    public function __construct(
        private UsuarioService $usuarioService,
        private Security       $security,
    )
    {
    }

    #[Route('/registro', name: 'registrar_usuario_cliente', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $this->usuarioService->registrarUsuario($data);
        return new JsonResponse(['message' => 'Usuario registrado con éxito'], 201);
    }

    #[Route('/renovar_token', name: 'renovar_token', methods: ['POST'])]
    public function renovar_token(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return $this->usuarioService->reenviarToken($data['correo']);
    }

    #[Route('/logout', name: 'logout', methods: ['POST'])]
    public function logout(Request $request): JsonResponse
    {
        $this->security->logout();
        return new JsonResponse(null, 204);
    }

    #[Route('/validar', name: 'validar_usuario', methods: ['POST'])]
    public function validarUsuario(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return $this->usuarioService->buscarUsuarioPorToken($data['token']);


    }
}