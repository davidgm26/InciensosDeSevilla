<?php

namespace App\Service;

use App\Dto\PerfilUsuarioResponse;
use App\Entity\Usuario;
use App\Repository\CategoriaRepository;
use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioService
{
    public function __construct(
        private UsuarioRepository $usuarioRepository,
        private ClienteService $clienteService,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager
    ) {}

    public function registrarUsuario(array $usuario)
    {
        if ($usuario['rol']==1){
            $user = $this->crearUsuario($usuario);
            $user->setRol('ROLE_ADMIN');
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $user;
        }else if($usuario['rol']==2){
            $user = $this->crearUsuario($usuario);
            $user->setRol("ROLE_CLIENTE");
            $this->entityManager->persist($user);
            $this->clienteService->crearCliente($usuario,$user);
            $this->entityManager->flush();
            return $user;
        }
    }

    public function crearUsuario(array $data): ?Usuario
    {
        $usuarioBuscado = $this->usuarioRepository->findByUsername($data['username']);
        if ($usuarioBuscado){
            throw new \Exception("El nombre de usuario ya existe");
        }
        $user = new Usuario();
        $user->setUsername($data['username']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
        return $user;
    }

    public function getAllProfileDetails(Usuario $usuario)
    {
        $cliente = $this->clienteService->getClienteByIdUsuario($usuario->getId());
        $resp = PerfilUsuarioResponse::createPerfilDtoResponseFromPerfil($usuario,$cliente);
        return $resp;
    }

    public function comprobarValidacionDeLaCuenta(Usuario $usuario)
    {
        if($usuario->getValidado() == false){
            return new JsonResponse("El usuario no está validado", Response::HTTP_METHOD_NOT_ALLOWED);
        }
        return new JsonResponse("Usuario Validado", Response::HTTP_OK);
    }
}