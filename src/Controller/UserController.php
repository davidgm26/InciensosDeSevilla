<?php

namespace App\Controller;

use App\Entity\Resenia;
use App\Entity\Usuario;
use App\Service\ReseniaService;
use App\Service\UsuarioService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/user')]
final class UserController extends AbstractController
{

    public function __construct(
        private UsuarioService $usuarioService,
        private Security       $security,
        private ReseniaService $reseniaService,
    )
    {}

    #[Route('/profile/details', name: 'get_cliente_details', methods: ['GET'])]
    public function getUserDetails()
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        return $this->json($this->usuarioService->getAllProfileDetails($usuario), Response::HTTP_OK);
    }

    #[Route('/validar', name: 'get_cliente', methods: ['GET'])]
    public function comprobarUsuarioValidado()
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        return $this->usuarioService->comprobarValidacionDeLaCuenta($usuario);
    }

    #[Route('/resenias', name: 'get_resenias_usuario', methods: ['GET'])]
    public function getReseniasUsuario()
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        return $this->json($this->usuarioService->getAllReseniasUsuario($usuario), Response::HTTP_OK);
    }

    #[Route('/borrar/resenia/{id}', name: 'delete_resenia', methods: ['DELETE'])]
    public function getReseniaUsuario(Resenia $resenia)
    {
        $this->reseniaService->borrarResenia($resenia);
        return $this->json("Reseña borrada con exito", Response::HTTP_NO_CONTENT);
    }

    #[Route('/profile/editar', name: 'editar_perfil', methods: ['PUT'])]
    public function editarPerfil(Request $request)
    {
        /** @var Usuario $usuario */
        $usuario = $this->security->getUser();
        $data = json_decode($request->getContent(),true);
        $this->usuarioService->editarPerfil($usuario, $data);
        return $this->json("Perfil actualizado con exito", Response::HTTP_OK);
    }
}