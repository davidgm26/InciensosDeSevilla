<?php

namespace App\Dto;

use App\Entity\Cliente;
use App\Entity\Pedido;
use App\Entity\Usuario;
use phpDocumentor\Reflection\Types\Self_;

class PerfilUsuarioResponse
{
    private int $numeroResenias;
    private int $numeroPedidos;
    private string $nombre;
    private string $apellidos;
    private string $telefono;
    private string $email;
    private string $direccion;
    private string $nombreDeUsuario;

    public function getNumeroResenias(): int
    {
        return $this->numeroResenias;
    }

    public function setNumeroResenias(int $numeroResenias): void
    {
        $this->numeroResenias = $numeroResenias;
    }

    public function getNumeroPedidos(): int
    {
        return $this->numeroPedidos;
    }

    public function setNumeroPedidos(int $numeroPedidos): void
    {
        $this->numeroPedidos = $numeroPedidos;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }
    public function getNombreDeUsuario(): string
    {
        return $this->nombreDeUsuario;
    }
    public function setNombreDeUsuario(string $nombreDeUsuario): void
    {
        $this->nombreDeUsuario = $nombreDeUsuario;
    }


    public static function createPerfilDtoResponseFromPerfil(Usuario $usuario, Cliente $cliente)
    {
        $dto = new Self();
        $dto->nombre = $cliente->getNombre();
        $dto->apellidos = $cliente ->getApellido();
        $dto->direccion = $cliente->getDireccion();
        $dto->nombreDeUsuario = $usuario->getUsername();
        $dto->numeroResenias = $cliente->getResenias()->count();
        $dto->numeroPedidos = $cliente->getPedidos()->count();
        $dto->telefono = $cliente->getTelefono();
        $dto->email = $cliente->getCorreo();
        return $dto;



    }


}