<?php

namespace App\Service;

use App\Entity\Cliente;
use App\Entity\Usuario;
use App\Repository\ClienteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClienteService
{

    public function __construct(
        private ClienteRepository $clienteRepository,
        private EntityManagerInterface $entityManager
    ){}

    public function crearCliente(array $request,Usuario $usuario): Cliente
    {
        $cliente = new Cliente();

        $cliente->setNombre($request['nombre']);
        $cliente->setApellido($request['apellidos']);
        $cliente->setDireccion($request['direccion']);

        $usuariotlf = $this->clienteRepository->findByTelefono($request['telefono']);
        if($usuariotlf){
            throw new \Exception("Ya existe un usuario con ese telefono");
        }
        $usuarioDni = $this->clienteRepository->findByDni($request['dni']);
        if($usuarioDni){
            throw new \Exception("Ya existe un usuario con ese DNI");
        }
        $usuarioMail = $this->clienteRepository->findByCorreo($request['correo']);
        if($usuarioMail){
            throw new \Exception("Ya existe un usuario con ese correo");
        }

        $cliente->setTelefono($request['telefono']);
        $cliente->setDni($request['dni']);
        $cliente->setCorreo($request['correo']);
        $cliente->setUsuario($usuario);
        $this->entityManager->persist($cliente);
        $this->entityManager->flush();
        return $cliente;
    }

    public function getClienteById(int $id):Cliente
    {
        return $this->clienteRepository->find($id);
    }


    public function getClienteByIdUsuario(int $id):Cliente
    {
        return $this->clienteRepository->findByIdUsuario($id);
    }

    public function findOneByCorreo($correo)
    {
        return $this->clienteRepository->findOneBy(['correo' => $correo]);
    }
}