<?php

namespace App\Dto;

use App\Entity\Cliente;

class ClienteResponse
{

    private $nombre;

    private $apellido;

    private $dni;

    private $telefono;

    private $direccion;

    public static function createClienteDto(Cliente $cliente) : ClienteResponse{

        $dto = new self();
        $dto->nombre = $cliente->getNombre();
        $dto->apellido = $cliente->getApellido();
        $dto->dni = $cliente->getDni();
        $dto->telefono = $cliente->getTelefono();
        $dto->direccion = $cliente->getDireccion();
        return $dto;
    }

    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function getApellido() : string
    {
        return $this->apellido;
    }
    public function getDni() : string
    {
        return $this->dni;
    }
    public function getTelefono() : string
    {
        return $this->telefono;
    }

}