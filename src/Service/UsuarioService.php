<?php

namespace App\Service;

use App\Entity\Usuario;
use App\Repository\CategoriaRepository;
use App\Repository\UsuarioRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Json;

class UsuarioService
{
    public function __construct(
        private UsuarioRepository           $usuarioRepository,
        private ClienteService              $clienteService,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface      $entityManager,
        private MailService $mailService
    )
    {
    }

    public function registrarUsuario(array $usuario)
    {
        if ($usuario['rol'] == 1) {
            $user = $this->crearUsuario($usuario);
            $user->setRol('ROLE_ADMIN');
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $user;
        } else if ($usuario['rol'] == 2) {
            $user = $this->crearUsuario($usuario);
            $user->setRol("ROLE_CLIENTE");
            $this->entityManager->persist($user);
            $cliente=$this->clienteService->crearCliente($usuario, $user);
            $this->entityManager->flush();
            $this->mailService->sendVerificationCodeEmail($cliente,$user->getToken());
            return $user;
        }
    }

    public function ºcrearUsuario(array $data): ?Usuario
    {
        $usuarioBuscado = $this->usuarioRepository->findByUsername($data['username']);
        if ($usuarioBuscado) {
            throw new \Exception("El nombre de usuario ya existe");
        }
        $user = new Usuario();
        $user->setUsername($data['username']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
        $user->setFechaCreacion((new \DateTime())->setTimestamp(time()));
        $this->crearNumeroDeVerificacion($user);
        return $user;
    }

    public function crearNumeroDeVerificacion(Usuario $user): int
    {
        $num = 4;
        $numGen = rand(pow(10, $num - 1), pow(10, $num) - 1);
        $user->setToken($numGen);
        return $numGen;
    }

    public function buscarUsuarioPorToken($token): JsonResponse
    {
        if($token == null){
            return new JsonResponse("El token de autenticacion no existe",501);
        }
        $usuario = $this->usuarioRepository->findOneBy(['token' => $token]);
        if ($usuario == null) {
            return new JsonResponse("No existe ningún usuario asignado a este token",401);
        }
        $expiracion = 1;
        $ahora = new \DateTime();
        $creacion = $usuario->getFechaValidacion();
        $transcurso = $creacion->diff($ahora);
        $diferenciaEnMinutos = ($transcurso->h * 60) + $transcurso->i;
        if ($diferenciaEnMinutos <= $expiracion) {
            $usuario->setToken(null);
            $usuario->setValidado(true);
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();
            return new JsonResponse("Usuario validad con exito", 200);
        }
    }
}