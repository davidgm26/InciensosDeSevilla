<?php

namespace App\Service;

use App\Dto\PerfilUsuarioResponse;
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

    public function crearUsuario(array $data): ?Usuario
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
    public function crearNumeroDeVerificacion(Usuario $user): int
    {
        $num = 4;
        $numGen = rand(pow(10, $num - 1), pow(10, $num) - 1);
        $user->setToken($numGen);
        return $numGen;
    }

    public function reenviarToken(string $correo)
    {
        $usuario = $this->usuarioRepository->findOneBy(['email' => $correo]);
        if ($usuario == null) {
            return new JsonResponse("No existe ningun usuario asignado con este correo");
        }
        $code = $this->crearNumeroDeVerificacion($usuario);
        $usuario->setToken($code);
        $this->entityManager->persist($usuario);
        $cliente = $this->clienteService->getClienteByIdUsuario($usuario->getId());
        $this->mailService->sendVerificationCodeEmail($cliente,$code);
        return new JsonResponse("Token enviado con exito");
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
        if($usuario->getValidado() == true){
            return new JsonResponse("El usuario" . $usuario->getUsername() . " ya esta validado",401);
        }
        $expiracion = 10;
        $ahora = new \DateTime();
        $creacion = $usuario->getFechaCreacion();
        $transcurso = $creacion->diff($ahora);
        $diferenciaEnMinutos = ($transcurso->h * 60) + $transcurso->i;
        if ($diferenciaEnMinutos <= $expiracion) {
            $usuario->setToken(null);
            $usuario->setValidado(true);
            $this->entityManager->persist($usuario);
            $this->entityManager->flush();
            $usuario->setFechaValidacion(new \DateTime());
            return new JsonResponse("Usuario validad con exito", 200);
        }
        return new JsonResponse("El token ha expirado", 400);
    }
}