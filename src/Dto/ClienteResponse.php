<?php

namespace App\Dto;

use App\Entity\Cliente;

class ClienteResponse extends UserResponse
{



    private $nombre;
    private $apellidos;
    private $correo;
    private $telefono;
    private $dni;
    private $direccion;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed $apellidos
     */
    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo): void
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni): void
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public static function createClienteResponse(Cliente $cliente)
    {
        $dto= new self();
        $userResponse = parent::createUserResponse($cliente->getUsuario());
        $dto->nombre = $cliente->getNombre();
        $dto->apellidos = $cliente->getApellido();
        $dto->dni = $cliente->getDni();
        $dto->telefono = $cliente->getTelefono();
        $dto->correo = $cliente->getCorreo();
        $dto->direccion = $cliente->getDireccion();
        $dto->username = $userResponse->getUsername();
        $dto->activo = $userResponse->getActivo();
        $dto->rol = $userResponse->getRol();
        $dto->id = $userResponse->getId();
        return $dto;
    }

}